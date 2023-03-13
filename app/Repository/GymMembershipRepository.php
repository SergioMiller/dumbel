<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\GymMembership;
use Illuminate\Database\Eloquent\Collection;

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
        return new Collection();
    }
}
