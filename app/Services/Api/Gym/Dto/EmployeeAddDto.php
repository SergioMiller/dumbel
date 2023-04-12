<?php

declare(strict_types=1);

namespace App\Services\Api\Gym\Dto;

use App\Enums\GymEmployeePositionEnum;
use Illuminate\Contracts\Support\Arrayable;

final class EmployeeAddDto implements Arrayable
{
    private readonly int $gym_id;

    private readonly int $user_id;

    private readonly GymEmployeePositionEnum $position;

    public function setGymId(int $gym_id): self
    {
        $this->gym_id = $gym_id;

        return $this;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function setPosition(GymEmployeePositionEnum $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getGymId(): int
    {
        return $this->gym_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getPosition(): GymEmployeePositionEnum
    {
        return $this->position;
    }

    public function toArray(): array
    {
        return [
            'gym_id' => $this->getGymId(),
            'user_id' => $this->getUserId(),
            'position' => $this->getPosition()->value,
        ];
    }
}
