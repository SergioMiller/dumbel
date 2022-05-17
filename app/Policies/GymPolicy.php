<?php
declare(strict_types=1);

namespace App\Policies;

use App\Models\Gym;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GymPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Gym $gym): bool
    {
        return $user->id === $gym->user_id;
    }
}
