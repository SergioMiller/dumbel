<?php

declare(strict_types=1);

namespace App\Services\Api\User;

use App\Models\User;
use App\Models\UserGymMembership;
use App\Repository\GymMembershipRepository;
use App\Repository\UserRepository;
use App\Services\Api\User\Dto\AttachGymMembershipDto;
use App\Services\Api\User\Dto\UserCreateDto;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly GymMembershipRepository $gymMembershipRepository
    ) {
    }

    public function create(UserCreateDto $data): User
    {
        DB::beginTransaction();
        $user = new User($data->toArray());
        $user->save();
        #TODO:create client card

        DB::commit();

        return $user;
    }

    public function gymMembershipAttachRequest(User $administrator, AttachGymMembershipDto $data): UserGymMembership
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
        $userGymMembership->created_at = Carbon::now()->toDateTimeString();

        $userGymMembership->save();

        return $userGymMembership;
    }
}
