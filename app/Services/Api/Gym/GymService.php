<?php

declare(strict_types=1);

namespace App\Services\Api\Gym;

use App\Enums\GymStatusEnum;
use App\Models\Gym;
use App\Models\GymEmployee;
use App\Models\User;
use App\Services\Api\Gym\Dto\EmployeeRemoveDto;
use App\Services\Api\Gym\Dto\GymCreateDto;
use App\Services\Api\Gym\Dto\GymUpdateDto;
use App\Services\Api\Gym\Dto\EmployeeAddDto;
use Carbon\Carbon;

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

    public function employeeAdd(EmployeeAddDto $data): int
    {
        return GymEmployee::query()->insertOrIgnore(array_merge(
            $data->toArray(),
            ['created_at' => Carbon::now()->toDateTimeString()]
        ));
    }

    public function employeeRemove(EmployeeRemoveDto $data): int
    {
        return GymEmployee::query()
            ->where('gym_id', $data->getGymId())
            ->where('user_id', $data->getUserId())
            ->where('position', $data->getPosition())
            ->delete();
    }
}
