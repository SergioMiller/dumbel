<?php

declare(strict_types=1);

namespace App\Services\Api\Gym;

use App\Enums\GymStatusEnum;
use App\Models\Gym;
use App\Models\GymManager;
use App\Models\GymTrainer;
use App\Models\User;
use App\Services\Api\Gym\Dto\GymCreateDto;
use App\Services\Api\Gym\Dto\GymUpdateDto;
use App\Services\Api\Gym\Dto\ManagerAddDto;
use App\Services\Api\Gym\Dto\ManagerRemoveDto;
use App\Services\Api\Gym\Dto\TrainerAddDto;
use App\Services\Api\Gym\Dto\TrainerRemoveDto;

class GymService
{
    public function create(User $user, GymCreateDto $data): Gym
    {
        $gym = new Gym($data->toArray());
        $gym->user_id = $user->id;
        $gym->status = GymStatusEnum::MODERATION->value;

        $gym->save();

        return $gym;
    }

    public function update(Gym $gym, GymUpdateDto $data): Gym
    {
        $gym->update($data->toArray());

        return $gym->fresh();
    }

    public function trainerAdd(TrainerAddDto $data): int
    {
        return GymTrainer::query()->insertOrIgnore($data->toArray());
    }

    public function trainerRemove(TrainerRemoveDto $data): int
    {
        return GymTrainer::query()->where($data->toArray())->delete();
    }

    public function managerAdd(ManagerAddDto $data): int
    {
        return GymManager::query()->insertOrIgnore($data->toArray());
    }

    public function managerRemove(ManagerRemoveDto $data): int
    {
        return GymManager::query()->where($data->toArray())->delete();
    }
}
