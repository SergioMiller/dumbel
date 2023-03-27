<?php

declare(strict_types=1);

namespace App\Services\Api\UserGymMembership\Dto;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

final class UserGymMembershipAttachDto implements Arrayable
{
    private readonly int $user_id;

    private readonly int $gym_membership_id;

    private readonly Carbon $date_start;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->user_id = $data['user_id'];
        $instance->gym_membership_id = $data['gym_membership_id'];
        $instance->date_start = Carbon::createFromDate($data['date_start']);

        return $instance;
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'gym_membership_id' => $this->gym_membership_id,
            'date_start' => $this->date_start,
        ];
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getMembershipId(): int
    {
        return $this->gym_membership_id;
    }

    public function getDateStart(): Carbon
    {
        return $this->date_start;
    }
}
