<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Exceptions\PasswordDoesNotMatchException;
use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Library\Response;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

final class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     description="Return a bearer token.",
     *     tags={"Auth"},
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *
     *         @OA\MediaType(
     *             mediaType="application/json",
     *
     *             @OA\Schema(
     *                 allOf={
     *                     @OA\Schema(ref="#/components/schemas/Response"),
     *                     @OA\Schema(
     *
     *                         @OA\Property(
     *                             property="data",
     *                             type="object",
     *                             @OA\Property(property="token", type="string", example="1|bmnVuChqwG0PoFoQfmrGRhHvHNvjV7gDoVHBcD6l"),
     *                         ),
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param LoginRequest $request
     *
     * @return JsonResponse
     *
     * @throws PasswordDoesNotMatchException
     * @throws UserNotFoundException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->authService->login($request->validated());

        return Response::success(['token' => $token]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/register",
     *     description="Return a bearer token.",
     *     tags={"Auth"},
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *
     *         @OA\MediaType(
     *             mediaType="application/json",
     *
     *             @OA\Schema(
     *                 allOf={
     *                     @OA\Schema(ref="#/components/schemas/Response"),
     *                     @OA\Schema(
     *
     *                         @OA\Property(
     *                             property="data",
     *                             type="object",
     *                             @OA\Property(property="token", type="string", example="1|bmnVuChqwG0PoFoQfmrGRhHvHNvjV7gDoVHBcD6l"),
     *                         ),
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param RegisterRequest $request
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $token = $this->authService->register($request->validated());

        return Response::success(['token' => $token]);
    }
}
