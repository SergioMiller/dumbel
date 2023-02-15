<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Exceptions\PasswordDoesNotMatchException;
use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterCheckQrCodeRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\RegisterWithQrCodeRequest;
use App\Library\Response;
use App\Repository\QrCodeRepository;
use App\Services\Auth\AuthService;
use App\Transformers\Auth\AuthAccountTransformer;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Ramsey\Uuid\Uuid;

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
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
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
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
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

    /**
     * @OA\Post(
     *     path="/api/v1/auth/register/check-qr-code",
     *     description="Check qr code before register.",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/RegisterCheckQrCodeRequest")
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
     *                             type="object",
     *                             @OA\Property(property="result", type="boolean", example="true"),
     *                         ),
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param RegisterCheckQrCodeRequest $request
     *
     * @return JsonResponse
     */
    public function checkQrCode(RegisterCheckQrCodeRequest $request): JsonResponse
    {
        return Response::success(['result' => $this->authService->checkQrCode($request->input('uuid'))]);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/auth/get-user/{uuid}",
     *     description="Get user.",
     *     tags={"Auth"},
     *     @OA\Parameter(
     *         name="uuid",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
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
     *                                 @OA\Schema(ref="#/components/schemas/AuthAccountTransformer")
     *                             }
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param string $uuid
     * @param QrCodeRepository $qrCodeRepository
     *
     * @return JsonResponse
     */
    public function getUserByQrCode(string $uuid, QrCodeRepository $qrCodeRepository): JsonResponse
    {
        $qrCode = $qrCodeRepository->getWithUserWhereIsEmptyPassword(Uuid::fromString($uuid));

        abort_if(null === $qrCode, 404, 'Not found.');
        abort_if(null === $qrCode->user, 404, 'Not found.');
        abort_if(null !== $qrCode->user->password, 404, 'Not found.');

        return Response::success(new AuthAccountTransformer($qrCode->user));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/register/{uuid}",
     *     description="Return a bearer token.",
     *     tags={"Auth"},
     *     @OA\Parameter(
     *         name="uuid",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/RegisterWithQrCodeRequest")
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
     * @param string $uuid
     * @param RegisterWithQrCodeRequest $request
     * @param QrCodeRepository $qrCodeRepository
     *
     * @return JsonResponse
     */
    public function registerWithQrCode(string $uuid, RegisterWithQrCodeRequest $request, QrCodeRepository $qrCodeRepository): JsonResponse
    {
        $qrCode = $qrCodeRepository->getWithUserWhereIsEmptyPassword(Uuid::fromString($uuid));

        abort_if(null === $qrCode, 404, 'Not found.');
        abort_if(null === $qrCode->user, 404, 'Not found.');
        abort_if(null !== $qrCode->user->password, 404, 'Not found.');

        $token = $this->authService->registerWithQrCode($qrCode, $request->validated());

        return Response::success(['token' => $token]);
    }
}
