<?php
declare(strict_types=1);

namespace App\Services\Api\Training\Dto;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;

class TrainingAddDto implements Arrayable
{
    private readonly int $gym_id;

    private readonly int $user_id;

    private readonly int|null $gym_membership_id;

    private readonly int|null $trainer_id;

    private readonly int $manager_id;

    private readonly Carbon $started_at;

    private readonly int|null $locker_number;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->gym_id = $data['gym_id'];
        $instance->user_id = $data['user_id'];
        $instance->gym_membership_id = $data['gym_membership_id'] ?? null;
        $instance->trainer_id = $data['trainer_id'] ?? null;
        $instance->manager_id = $data['manager_id'];
        $instance->started_at = isset($data['started_at']) ? Carbon::createFromFormat('Y-m-d H:i:s', $data['started_at']) : Carbon::now();
        $instance->locker_number = $data['locker_number'] ?? null;

        return $instance;
    }

    public function toArray(): array
    {
        return [
            'gym_id' => $this->gym_id,
            'user_id' => $this->user_id,
            'gym_membership_id' => $this->gym_membership_id,
            'trainer_id' => $this->trainer_id,
            'manager_id' => $this->manager_id,
            'started_at' => $this->started_at->toDateTimeString(),
            'locker_number' => $this->locker_number,
        ];
    }
}
