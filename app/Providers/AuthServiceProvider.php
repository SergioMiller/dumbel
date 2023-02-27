<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Gym;
use App\Models\Subscription;
use App\Policies\GymPolicy;
use App\Policies\SubscriptionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Gym::class => GymPolicy::class,
        Subscription::class => SubscriptionPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
