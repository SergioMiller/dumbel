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

class AuthController extends Controller
{
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     description="Return a bearer token.",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/RequestLogin")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 allOf={
     *                     @OA\Schema(ref="#/components/schemas/Response"),
     *                     @OA\Schema(
     *                         @OA\Property(
     *                             property="data",
     *                             allOf={
     *                                 @OA\Schema(ref="#/components/schemas/ResponseLogin")
     *                             }
     *                         )
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
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/RequestRegister")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 allOf={
     *                     @OA\Schema(ref="#/components/schemas/Response"),
     *                     @OA\Schema(
     *                         @OA\Property(
     *                             property="data",
     *                             allOf={
     *                                 @OA\Schema(ref="#/components/schemas/ResponseRegister")
     *                             }
     *                         )
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
