<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Account\AccountUpdateRequest;
use App\Http\Requests\Api\GymMembership\GymMembershipAttachRequest;
use App\Http\Requests\Api\GymMembership\GymMembershipCreateRequest;
use App\Http\Requests\Api\GymMembership\GymMembershipUpdateRequest;
use App\Library\Response;
use App\Repository\GymMembershipRepository;
use App\Services\Api\GymMembership\Dto\GymMembershipAttachDto;
use App\Services\Api\GymMembership\Dto\GymMembershipCreateDto;
use App\Services\Api\GymMembership\Dto\GymMembershipUpdateDto;
use App\Services\Api\GymMembership\GymMembershipService;
use App\Transformers\GymMembership\GymMembershipTransformer;
use App\Transformers\GymMembership\UserGymMembershipTransformer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

final class GymMembershipController extends Controller
{
    public function __construct(
        private readonly GymMembershipService $gymMembershipService,
        private readonly GymMembershipRepository $gymMembershipRepository
    ) {
    }

    /**
     * @OA\Post(
     *     path="/api/v1/gym-membership/create",
     *     description="Gym membership create.",
     *     tags={"Gym membership"},
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/GymMembershipCreateRequest")
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
     *                                 @OA\Schema(ref="#/components/schemas/GymMembershipTransformer")
     *                             }
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param GymMembershipCreateRequest $request
     *
     * @return JsonResponse
     */
    public function create(GymMembershipCreateRequest $request): JsonResponse
    {
        $model = $this->gymMembershipService->create(GymMembershipCreateDto::fromArray($request->validated()));

        return Response::success(new GymMembershipTransformer($model));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/gym-membership/{id}",
     *     description="Gym membership get.",
     *     tags={"Gym membership"},
     *     security={
     *         {"bearerAuth" : {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="int")
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
     *                                 @OA\Schema(ref="#/components/schemas/GymMembershipTransformer")
     *                             }
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function get(int $id): JsonResponse
    {
        $model = $this->gymMembershipRepository->getById($id);

        abort_if(null === $model, 404, 'Not found.');

        return Response::success(new GymMembershipTransformer($model));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/gym-membership/{id}/update",
     *     description="Gym membership update.",
     *     tags={"Gym membership"},
     *     security={
     *         {"bearerAuth" : {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="int")
     *     ),
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/GymMembershipUpdateRequest")
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
     *                                 @OA\Schema(ref="#/components/schemas/GymMembershipTransformer")
     *                             }
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param int $id
     * @param GymMembershipUpdateRequest $request
     *
     * @return JsonResponse
     *
     * @throws AuthorizationException
     */
    public function update(int $id, GymMembershipUpdateRequest $request): JsonResponse
    {
        $model = $this->gymMembershipRepository->getById($id);

        abort_if(null === $model, 404, 'Not found.');

        $this->authorize('update', $model);

        $model = $this->gymMembershipService->update($model, GymMembershipUpdateDto::fromArray($request->validated()));

        return Response::success(new GymMembershipTransformer($model));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/gym-membership/{gym_id}/list",
     *     description="Gym membership by gym list.",
     *     tags={"Gym membership"},
     *     security={
     *         {"bearerAuth" : {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="gym_id",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="int")
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
     *                             type="array",
     *
     *                             @OA\Items(ref="#/components/schemas/GymMembershipTransformer")
     *                         )
     *                     ),
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function listByGym(int $id): JsonResponse
    {
        $gymMembership = $this->gymMembershipRepository->getListByGymId($id);

        return Response::success(new GymMembershipTransformer($gymMembership));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/gym-membership/attach",
     *     description="Gym membership attach.",
     *     tags={"Gym membership"},
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/GymMembershipAttachRequest")
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
     *                                 @OA\Schema(ref="#/components/schemas/UserGymMembershipTransformer")
     *                             }
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param GymMembershipAttachRequest $request
     *
     * @return JsonResponse
     */
    public function gymMembershipAttach(GymMembershipAttachRequest $request): JsonResponse
    {
        $data = $this->gymMembershipService->gymMembershipAttach(
            $request->user(),
            GymMembershipAttachDto::fromArray($request->validated())
        );

        return Response::success(new UserGymMembershipTransformer($data));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/gym-membership/active",
     *     description="Active list for current user.",
     *     tags={"Gym membership"},
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
     *                                 @OA\Schema(ref="#/components/schemas/UserGymMembershipTransformer")
     *                             }
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param AccountUpdateRequest $request
     *
     * @return JsonResponse
     */
    public function gymMembershipActive(Request $request): JsonResponse
    {
        $activeGymMembership = $this->gymMembershipRepository->getActiveForUser($request->user()->id);

        return Response::success(new UserGymMembershipTransformer($activeGymMembership));
    }
}
