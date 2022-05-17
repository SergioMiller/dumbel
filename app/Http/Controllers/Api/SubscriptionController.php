<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Subscription\SubscriptionCreateRequest;
use App\Http\Requests\Api\Subscription\SubscriptionUpdateRequest;
use App\Library\Response;
use App\Models\Subscription;
use App\Services\SubscriptionService;
use App\Transformers\SubscriptionTransformer;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    private SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/subscription/create",
     *     description="Create subscription.",
     *     tags={"Subscription"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/RequestSubscriptionCreate")
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
     *                                 @OA\Schema(ref="#/components/schemas/ResponseSubscription")
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
     *                                 @OA\Schema(ref="#/components/schemas/ResponseSubscription")
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
        /** @var Subscription $model */
        $model = Subscription::query()->where('id', $id)->first();

        abort_if($model === null, 404, 'Not found.');

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
     *         @OA\JsonContent(ref="#/components/schemas/RequestSubscriptionUpdate")
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
     *                                 @OA\Schema(ref="#/components/schemas/ResponseSubscription")
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
     */
    public function update(int $id, SubscriptionUpdateRequest $request): JsonResponse
    {
        /** @var Subscription $model */
        $model = Subscription::query()->where('id', $id)->first();

        abort_if($model === null, 404, 'Not found.');

        $model = $this->subscriptionService->update($model, $request->validated());

        return Response::success(new SubscriptionTransformer($model));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/subscription/{gym_id}list",
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
     *                             @OA\Items(ref="#/components/schemas/ResponseSubscription")
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
        $subscriptions = Subscription::query()->where('gym_id', $id)->orderBy('price')->get();

        return Response::success(new SubscriptionTransformer($subscriptions));
    }
}
