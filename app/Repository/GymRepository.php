<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Gym;
use App\Models\GymManager;
use App\Models\GymTrainer;
use Illuminate\Support\Collection;

class GymRepository
{
    public function __construct(private readonly Gym $model)
    {
    }

    public function getById(int $id): Gym|null
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->model::query()->where('id', $id)->first();
    }

    public function getByUserId($id): Collection
    {
        return $this->model::query()->where('user_id', $id)->with(['trainers', 'managers'])->get();
    }

    public function userHasAccess(int $gymId, int $userId): bool
    {
        $isGymOwner = $this->model::query()
            ->where('id', $gymId)
            ->where('user_id', $userId)
            ->exists();

        if ($isGymOwner) {
            return true;
        }

        $isTrainer = GymTrainer::query()
            ->where('gym_id', $gymId)
            ->where('user_id', $userId)
            ->exists();

        if ($isTrainer) {
            return true;
        }

        $isManager = GymManager::query()
            ->where('gym_id', $gymId)
            ->where('user_id', $userId)
            ->exists();

        if ($isManager) {
            return true;
        }

        return false;
    }
}
