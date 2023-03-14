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
    public function __construct(private readonly GymMembership $model)
    {
    }

    public function getById(int $id): GymMembership|null
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->model->newQuery()->where('id', $id)->first();
    }

    public function getListByGymId(int $id): Collection
    {
        return $this->model->query()->where('gym_id', $id)->orderBy('price')->get();
    }

    public function update(int $id, array $data): GymMembership
    {
        /**
         * @var GymMembership $model
         */
        $model = $this->model->query()->where('id', $id)->firstOrFail();

        $model->update($data);

        return $model->fresh();
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
