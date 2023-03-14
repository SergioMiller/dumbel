<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\UserGymMembership;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserGymMembershipPolicy
{
    use HandlesAuthorization;

    public function freeze(User $user, UserGymMembership $userGymMembership): bool
    {
        return $user->id === $userGymMembership->user_id;
    }
}
