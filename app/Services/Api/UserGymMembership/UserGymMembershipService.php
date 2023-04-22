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

        $entity = new UserGymMembership();
        $entity->user_id = $user->id;
        $entity->gym_id = $gymMembership->gym_id;
        $entity->gym_membership_id = $gymMembership->id;
        $entity->administrator_id = $administrator->id;
        $entity->name = $gymMembership->name;
        $entity->day_quantity = $gymMembership->day_quantity;
        $entity->freeze_day_quantity = $gymMembership->freeze_day_quantity;
        $entity->works_from = $gymMembership->works_from;
        $entity->works_to = $gymMembership->works_to;
        $entity->training_quantity = $gymMembership->training_quantity;
        $entity->price = $gymMembership->price;
        $entity->status = GymMembershipStatusEnum::ACTIVE->value;
        $entity->date_start = $data->getDateStart()->toDateString();
        $entity->created_at = Carbon::now()->toDateTimeString();

        $entity->save();

        return $entity;
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

        $entity = new UserGymMembershipFreeze();
        $entity->user_gym_membership_id = $data->getUserGymMembershipId();
        $entity->date_start = $data->getDateStart();
        $entity->date_end = $data->getDateEnd();
        $entity->day_quantity = $diffInDays;
        $entity->save();

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
