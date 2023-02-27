<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [

    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });
    }

    protected function convertExceptionToArray(Throwable $e): array
    {
        return config('app.debug') ? [
            'success' => false,
            'message' => $e->getMessage(),
            'meta' => [],
            'data' => [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => collect($e->getTrace())->map(function ($trace) {
                    return Arr::except($trace, ['args']);
                })->all()
            ],
        ] : [
            'success' => false,
            'message' => $this->isHttpException($e) ? $e->getMessage() : 'Server Error',
            'meta' => [],
            'data' => [],
        ];
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json([
                'success' => false,
                'message' => $exception->getMessage() ?? 'Server Error',
                'meta' => [],
                'data' => [],
            ], 401)
            : redirect()->guest($exception->redirectTo() ?? route('login'));
    }
}
