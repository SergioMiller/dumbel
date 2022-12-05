<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Subscription\SubscriptionCreateRequest;
use App\Http\Requests\Api\Subscription\SubscriptionUpdateRequest;
use App\Library\Response;
use App\Repository\SubscriptionRepository;
use App\Services\Api\SubscriptionService;
use App\Transformers\SubscriptionTransformer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    private SubscriptionService $subscriptionService;

    private SubscriptionRepository $subscriptionRepository;

    public function __construct(SubscriptionService $subscriptionService, SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionService = $subscriptionService;
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/subscription/create",
     *     description="Create subscription.",
     *     tags={"Subscription"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/SubscriptionCreateRequest")
     *     ),
     *     security={
     *         {"bearerAuth" : {}}
     *     },
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
     *                                 @OA\Schema(ref="#/components/schemas/SubscriptionTransformer")
     *                             }
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param SubscriptionCreateRequest $request
     *
     * @return JsonResponse
     */
    public function create(SubscriptionCreateRequest $request): JsonResponse
    {
        $model = $this->subscriptionService->create($request->validated());

        return Response::success(new SubscriptionTransformer($model));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/subscription/{id}",
     *     description="Get subscription.",
     *     tags={"Subscription"},
     *     security={
     *         {"bearerAuth" : {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="int")
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
     *                                 @OA\Schema(ref="#/components/schemas/SubscriptionTransformer")
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
        $model = $this->subscriptionRepository->getById($id);

        abort_if(null === $model, 404, 'Not found.');

        return Response::success(new SubscriptionTransformer($model));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/subscription/{id}/update",
     *     description="Update subscription.",
     *     tags={"Subscription"},
     *     security={
     *         {"bearerAuth" : {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="int")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/SubscriptionUpdateRequest")
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
     *                                 @OA\Schema(ref="#/components/schemas/SubscriptionTransformer")
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
     * @param SubscriptionUpdateRequest $request
     *
     * @return JsonResponse
     *
     * @throws AuthorizationException
     */
    public function update(int $id, SubscriptionUpdateRequest $request): JsonResponse
    {
        $model = $this->subscriptionRepository->getById($id);

        $this->authorize('update', $model);

        abort_if(null === $model, 404, 'Not found.');

        $model = $this->subscriptionService->update($model, $request->validated());

        return Response::success(new SubscriptionTransformer($model));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/subscription/{gym_id}/list",
     *     description="List subscription.",
     *     tags={"Subscription"},
     *     security={
     *         {"bearerAuth" : {}}
     *     },
     *     @OA\Parameter(
     *         name="gym_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="int")
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
     *                             type="array",
     *                             @OA\Items(ref="#/components/schemas/SubscriptionTransformer")
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
        $subscriptions = $this->subscriptionRepository->getListByGymId($id);

        return Response::success(new SubscriptionTransformer($subscriptions));
    }
}
