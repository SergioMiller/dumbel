<?php

declare(strict_types=1);

namespace App\Services\Api\Gym\Dto;

use Illuminate\Contracts\Support\Arrayable;

final class ManagerRemoveDto implements Arrayable
{
    private readonly int $gym_id;

    private readonly int $user_id;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->gym_id = $data['gym_id'];
        $instance->user_id = $data['user_id'];

        return $instance;
    }

    public function toArray(): array
    {
        return [
            'gym_id' => $this->gym_id,
            'user_id' => $this->user_id,
        ];
    }
}
