<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasAccessToGymMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        return $next($request);
    }
}
