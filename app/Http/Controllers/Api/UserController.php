<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\AttachSubscriptionRequest;
use App\Http\Requests\Api\User\UserCreateRequest;
use App\Library\Response;
use App\Services\Api\User\Dto\AttachSubscriptionDto;
use App\Services\Api\User\Dto\UserCreateDto;
use App\Services\Api\User\UserService;
use App\Transformers\User\UserSubscriptionTransformer;
use App\Transformers\User\UserTransformer;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

final class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    /**
     * @OA\Post(
     *     path="/api/v1/user/create",
     *     description="Create user.",
     *     tags={"User"},
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/UserCreateRequest")
     *     ),
     *     security={
     *         {"bearerAuth" : {}}
     *     },
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
     *                             allOf={
     *
     *                                 @OA\Schema(ref="#/components/schemas/UserTransformer")
     *                             }
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param UserCreateRequest $request
     *
     * @return JsonResponse
     */
    public function create(UserCreateRequest $request): JsonResponse
    {
        $user = $this->userService->create(UserCreateDto::fromArray($request->validated()));

        return Response::success(new UserTransformer($user));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/user/attach-subscription",
     *     description="Attach subscrittion.",
     *     tags={"User"},
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/AttachSubscribeRequest")
     *     ),
     *     security={
     *         {"bearerAuth" : {}}
     *     },
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
     *                             allOf={
     *
     *                                 @OA\Schema(ref="#/components/schemas/UserSubscriptionTransformer")
     *                             }
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param AttachSubscriptionRequest $request
     *
     * @return JsonResponse
     */
    public function attachSubscription(AttachSubscriptionRequest $request): JsonResponse
    {
        $data = $this->userService->attachSubscription(
            $request->user(),
            AttachSubscriptionDto::fromArray($request->validated())
        );

        return Response::success(new UserSubscriptionTransformer($data));
    }
}
