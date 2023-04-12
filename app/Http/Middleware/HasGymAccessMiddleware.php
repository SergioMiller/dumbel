<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Repository\GymRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasGymAccessMiddleware
{
    public function __construct(private readonly GymRepository $gymRepository)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        abort_if(
            !$request->hasHeader('authorization-gym-id'),
            422,
            'Header AUTHORIZATION-GYM-ID is required.'
        );

        $userHasAccess = $this->gymRepository->userHasAccess(
            (int) $request->header('authorization-gym-id'),
            $request->user()->id
        );

        abort_if(false === $userHasAccess, 403, 'User doesnt have gym access.');

        return $next($request);
    }
}
