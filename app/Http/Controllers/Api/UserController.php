<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserCreateRequest;
use App\Library\Response;
use App\Repository\UserRepository;
use App\Services\Api\User\Dto\UserCreateDto;
use App\Services\Api\User\UserService;
use App\Http\Transformers\User\UserInfoTransformer;
use App\Http\Transformers\User\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

final class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly UserRepository $userRepository,
    ) {
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
        $entity = $this->userService->create(UserCreateDto::fromArray($request->validated()));

        return Response::success(new UserTransformer($entity));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/user/{barcode}",
     *     description="Get user by barcode.",
     *     tags={"User"},
     *     security={
     *         {"bearerAuth" : {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="AUTHORIZATION-GYM-ID",
     *         in="header",
     *         required=true,
     *
     *         @OA\Schema(type="int")
     *     ),
     *
     *     @OA\Parameter(
     *         name="barcode",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="string")
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
     *                             allOf={
     *
     *                                 @OA\Schema(ref="#/components/schemas/UserInfoTransformer")
     *                             }
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param string $barcode
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getByBarcode(string $barcode, Request $request): JsonResponse
    {
        $entity = $this->userRepository->getByBarcodeForGym($barcode, (int) $request->header('authorization-gym-id'));

        abort_if(null === $entity, 404);

        return Response::success(new UserInfoTransformer($entity));
    }
}
