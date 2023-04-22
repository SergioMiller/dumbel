<?php

declare(strict_types=1);

namespace App\Repository;

use App\Enums\GymMembershipStatusEnum;
use App\Models\UserGymMembership;
use App\Models\UserGymMembershipFreeze;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserGymMembershipRepository
{
    public function __construct(private readonly UserGymMembership $entity)
    {
    }

    public function getById(int $id): UserGymMembership|null
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->entity->newQuery()
            ->with('freezes')
            ->where('id', $id)->first();
    }

    public function getActiveForUser(int $userId): Collection
    {
        return $this->entity->newQuery()
            ->where('user_id', $userId)
            ->where('status', GymMembershipStatusEnum::ACTIVE->value)
            ->where('date_start', '>=', DB::raw("NOW() - interval '1 day' * day_quantity"))
            ->get();
    }

    public function getByGymMembershipFreezesId(int $id): Collection
    {
        return UserGymMembershipFreeze::query()
            ->where('user_gym_membership_id', $id)
            ->get();
    }
}
