<?php

declare(strict_types=1);

namespace App\Services\Api\UserGymMembership;

use App\Enums\GymMembershipStatusEnum;
use App\Exceptions\FreezeDaysAvailableLimitExceededException;
use App\Exceptions\FreezeDaysHasCrossDatesException;
use App\Exceptions\FreezeDaysIncorrectFrameException;
use App\Models\User;
use App\Models\UserGymMembership;
use App\Models\UserGymMembershipFreeze;
use App\Repository\GymMembershipRepository;
use App\Repository\UserGymMembershipRepository;
use App\Repository\UserRepository;
use App\Services\Api\UserGymMembership\Dto\UserGymMembershipAttachDto;
use App\Services\Api\UserGymMembership\Dto\UserGymMembershipFreezeDto;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserGymMembershipService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly GymMembershipRepository $gymMembershipRepository,
        private readonly UserGymMembershipRepository $userGymMembershipRepository
    ) {
    }

    public function gymMembershipAttach(User $administrator, UserGymMembershipAttachDto $data): UserGymMembership
    {
        $user = $this->userRepository->getById($data->getUserId());

        if (null === $user) {
            throw new NotFoundHttpException('User not found.');
        }

        $gymMembership = $this->gymMembershipRepository->getById($data->getMembershipId());

        if (null === $gymMembership) {
            throw new NotFoundHttpException('Gym membership not found.');
        }

        $model = new UserGymMembership();
        $model->user_id = $user->id;
        $model->gym_id = $gymMembership->gym_id;
        $model->gym_membership_id = $gymMembership->id;
        $model->administrator_id = $administrator->id;
        $model->name = $gymMembership->name;
        $model->day_quantity = $gymMembership->day_quantity;
        $model->freeze_day_quantity = $gymMembership->freeze_day_quantity;
        $model->works_from = $gymMembership->works_from;
        $model->works_to = $gymMembership->works_to;
        $model->training_quantity = $gymMembership->training_quantity;
        $model->price = $gymMembership->price;
        $model->status = GymMembershipStatusEnum::ACTIVE->value;
        $model->date_start = $data->getDateStart()->toDateString();
        $model->created_at = Carbon::now()->toDateTimeString();

        $model->save();

        return $model;
    }

    /**
     * @throws FreezeDaysAvailableLimitExceededException
     * @throws FreezeDaysIncorrectFrameException
     */
    public function freeze(UserGymMembership $gymMembership, UserGymMembershipFreezeDto $data): UserGymMembership
    {
        $dateStart = Carbon::createFromDate($data->getDateStart());
        $dateEnd = Carbon::createFromDate($data->getDateEnd());
        $diffInDays = $dateStart->diffInDays($dateEnd) + 1;

        $userGymMembershipFreezes = $this->userGymMembershipRepository->getByGymMembershipFreezesId(
            $data->getUserGymMembershipId()
        );

        #Перевірка початку та кінця абонементу.
        if ($this->hasIncorrectDateFrame($gymMembership, $dateStart, $dateEnd)) {
            throw new FreezeDaysIncorrectFrameException();
        }

        #Перевищено ліміт доступних днів заморожування.
        $userGymMembershipFreezeUsedDyaQuantity = $userGymMembershipFreezes->sum('day_quantity');

        if ($userGymMembershipFreezeUsedDyaQuantity + $diffInDays > $gymMembership->freeze_day_quantity) {
            throw new FreezeDaysAvailableLimitExceededException();
        }

        #Дати заморозки мають перехресні дати з активними заморозками.
        $userGymMembershipFreezes->map(function (UserGymMembershipFreeze $freeze) use ($data) {
            if ($this->hasCrossDates($freeze, $data)) {
                throw new FreezeDaysHasCrossDatesException();
            }
        });

        $model = new UserGymMembershipFreeze();
        $model->user_gym_membership_id = $data->getUserGymMembershipId();
        $model->date_start = $data->getDateStart();
        $model->date_end = $data->getDateEnd();
        $model->day_quantity = $diffInDays;
        $model->save();

        $dateToday = Carbon::today();

        if ($dateToday->between($dateStart, $dateEnd)) {
            $gymMembership->update(['status' => GymMembershipStatusEnum::FREEZE->value]);
        }

        return $gymMembership->fresh();
    }

    private function hasCrossDates(UserGymMembershipFreeze $freeze, UserGymMembershipFreezeDto $data): bool
    {
        $dateStart = Carbon::createFromDate($freeze->date_start);
        $dateEnd = Carbon::createFromDate($freeze->date_end);

        $newDateStart = Carbon::createFromDate($data->getDateStart());
        $newDateEnd = Carbon::createFromDate($data->getDateEnd());

        return $newDateStart->between($dateStart, $dateEnd) || $newDateEnd->between($dateStart, $dateEnd);
    }

    private function hasIncorrectDateFrame(UserGymMembership $gymMembership, Carbon $dateStart, Carbon $dateEnd): bool
    {
        $gymMembershipDateStart = Carbon::createFromDate($gymMembership->date_start);
        $gymMembershipDateEnd = Carbon::createFromDate($gymMembership->date_end);

        return $dateStart < $gymMembershipDateStart || $dateStart > $gymMembershipDateEnd || $dateEnd < $gymMembershipDateStart || $dateEnd > $gymMembershipDateEnd;
    }
}
