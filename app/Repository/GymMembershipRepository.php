<?php

declare(strict_types=1);

namespace App\Repository;

use App\Enums\GymMembershipStatusEnum;
use App\Models\GymMembership;
use App\Models\UserGymMembership;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class GymMembershipRepository
{
    public function __construct(private readonly GymMembership $entity)
    {
    }

    public function getById(int $id): GymMembership|null
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->entity->newQuery()->where('id', $id)->first();
    }

    public function getListByGymId(int $id): Collection
    {
        return $this->entity->query()->where('gym_id', $id)->orderBy('price')->get();
    }

    public function update(int $id, array $data): GymMembership
    {
        /**
         * @var GymMembership $entity
         */
        $entity = $this->entity->query()->where('id', $id)->firstOrFail();

        $entity->update($data);

        return $entity->fresh();
    }

    public function getActiveForUser(int $userId): Collection
    {
        return UserGymMembership::query()
            ->where('user_id', $userId)
            ->where('status', GymMembershipStatusEnum::ACTIVE->value)
            ->where('date_start', '>=', DB::raw("NOW() - interval '1 day' * day_quantity"))
            ->get();
    }
}
