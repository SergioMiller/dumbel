<?php

declare(strict_types=1);

namespace App\Services\Api\UserGymMembership\Dto;

use Illuminate\Contracts\Support\Arrayable;

final class UserGymMembershipFreezeDto implements Arrayable
{
    private readonly int $user_gym_membership_id;

    private readonly string $date_start;

    private readonly string $date_end;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->user_gym_membership_id = $data['user_gym_membership_id'];
        $instance->date_start = $data['date_start'];
        $instance->date_end = $data['date_end'];

        return $instance;
    }

    public function toArray(): array
    {
        return [
            'user_gym_membership_id' => $this->user_gym_membership_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
        ];
    }

    public function getUserGymMembershipId(): int
    {
        return $this->user_gym_membership_id;
    }

    public function getDateStart(): string
    {
        return $this->date_start;
    }

    public function getDateEnd(): string
    {
        return $this->date_end;
    }
}
