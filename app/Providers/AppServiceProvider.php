<?php

declare(strict_types=1);

namespace App\Providers;

use App\Library\ResponseFactory;
use Illuminate\Contracts\Routing\ResponseFactory as ResponseFactoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ResponseFactoryInterface::class, ResponseFactory::class);
    }

    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
