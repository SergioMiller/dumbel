<?php

declare(strict_types=1);

namespace App\Services\Api\GymMembership;

use App\Enums\GymMembershipStatusEnum;
use App\Models\GymMembership;
use App\Models\User;
use App\Models\UserGymMembership;
use App\Repository\GymMembershipRepository;
use App\Repository\UserRepository;
use App\Services\Api\GymMembership\Dto\GymMembershipAttachDto;
use App\Services\Api\GymMembership\Dto\GymMembershipCreateDto;
use App\Services\Api\GymMembership\Dto\GymMembershipUpdateDto;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GymMembershipService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly GymMembershipRepository $gymMembershipRepository
    ) {
    }

    public function create(GymMembershipCreateDto $data): GymMembership
    {
        $model = new GymMembership($data->toArray());

        $model->save();

        return $model;
    }

    public function update(GymMembership $model, GymMembershipUpdateDto $data): GymMembership
    {
        $model->update($data->toArray());

        return $model->fresh();
    }

    public function gymMembershipAttach(User $administrator, GymMembershipAttachDto $data): UserGymMembership
    {
        $user = $this->userRepository->getById($data->getUserId());

        if (null === $user) {
            throw new NotFoundHttpException('User not found.');
        }

        $gymMembership = $this->gymMembershipRepository->getById($data->getMembershipId());

        if (null === $gymMembership) {
            throw new NotFoundHttpException('Gym membership not found.');
        }

        $userGymMembership = new UserGymMembership();
        $userGymMembership->user_id = $user->id;
        $userGymMembership->gym_id = $gymMembership->gym_id;
        $userGymMembership->gym_membership_id = $gymMembership->id;
        $userGymMembership->administrator_id = $administrator->id;
        $userGymMembership->name = $gymMembership->name;
        $userGymMembership->day_quantity = $gymMembership->day_quantity;
        $userGymMembership->freeze_day_quantity = $gymMembership->freeze_day_quantity;
        $userGymMembership->works_from = $gymMembership->works_from;
        $userGymMembership->works_to = $gymMembership->works_to;
        $userGymMembership->training_quantity = $gymMembership->training_quantity;
        $userGymMembership->price = $gymMembership->price;
        $userGymMembership->status = GymMembershipStatusEnum::ACTIVE->value;
        $userGymMembership->date_start = $data->getDateStart();
        $userGymMembership->created_at = Carbon::now()->toDateTimeString();

        $userGymMembership->save();

        return $userGymMembership;
    }
}
