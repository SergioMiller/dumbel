<?php
declare(strict_types=1);

namespace App\Policies;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriptionPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Subscription $subscription): bool
    {
        return $user->id === $subscription->gym->user_id;
    }
}
