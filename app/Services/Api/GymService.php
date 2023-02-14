<?php
declare(strict_types=1);

namespace App\Services\Api;

use App\Enums\GymStatusEnum;
use App\Models\Gym;
use App\Models\GymManager;
use App\Models\GymTrainer;
use App\Models\User;

class GymService
{
    public function create(User $user, array $data): Gym
    {
        $gym = new Gym($data);
        $gym->user_id = $user->id;
        $gym->status = GymStatusEnum::MODERATION->value;

        $gym->save();

        return $gym;
    }

    public function update(Gym $gym, array $data): Gym
    {
        $gym->update($data);

        return $gym->fresh();
    }

    public function trainerAdd(array $data): bool
    {
        return GymTrainer::query()->insert($data);
    }

    public function trainerRemove(array $data): int
    {
        return GymTrainer::query()->where($data)->delete();
    }

    public function managerAdd(array $data): bool
    {
        return GymManager::query()->insert($data);
    }

    public function managerRemove(array $data): int
    {
        return GymManager::query()->where($data)->delete();
    }
}
