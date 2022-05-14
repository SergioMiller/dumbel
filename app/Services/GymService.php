<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Gym;
use App\Models\User;

class GymService
{
    public function create(User $user, array $data): Gym
    {
        $gym = new Gym($data);
        $gym->user_id = $user->id;

        $gym->save();

        return $gym;
    }

    public function update(Gym $gym, array $data): Gym
    {
        $gym->update($data);

        return $gym->fresh();
    }
}
