<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Gym;
use App\Models\GymMembership;
use App\Policies\GymPolicy;
use App\Policies\GymMembershipPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Gym::class => GymPolicy::class,
        GymMembership::class => GymMembershipPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
