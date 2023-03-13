<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\GymMembership;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GymMembershipPolicy
{
    use HandlesAuthorization;

    public function update(User $user, GymMembership $gymMembership): bool
    {
        return $user->id === $gymMembership->gym->user_id;
    }
}
