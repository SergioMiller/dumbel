<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Gym\GymCreateRequest;
use App\Http\Requests\Api\Gym\GymUpdateRequest;
use App\Http\Requests\Api\Gym\ManagerAddRequest;
use App\Http\Requests\Api\Gym\ManagerRemoveRequest;
use App\Http\Requests\Api\Gym\TrainerAddRequest;
use App\Http\Requests\Api\Gym\TrainerRemoveRequest;
use App\Library\Response;
use App\Repository\GymRepository;
use App\Services\Api\GymService;
use App\Transformers\GymTransformer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GymController extends Controller
{
    private GymService $gymService;

    private GymRepository $gymRepository;

    public function __construct(GymService $gymService, GymRepository $gymRepository)
    {
        $this->gymService = $gymService;
        $this->gymRepository = $gymRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/gym/create",
     *     description="Create gym.",
     *     tags={"Gym"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/GymCreateRequest")
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
     *                                 @OA\Schema(ref="#/components/schemas/GymTransformer")
     *                             }
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param GymCreateRequest $request
     *
     * @return JsonResponse
     */
    public function create(GymCreateRequest $request): JsonResponse
    {
        $gym = $this->gymService->create($request->user(), $request->validated());

        return Response::success(new GymTransformer($gym));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/gym/{id}",
     *     description="Get gym.",
     *     tags={"Gym"},
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
     *                                 @OA\Schema(ref="#/components/schemas/GymTransformer")
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
        $model = $this->gymRepository->getById($id);

        abort_if(null === $model, 404, 'Not found.');

        return Response::success(new GymTransformer($model));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/gym/{id}/update",
     *     description="Update gym.",
     *     tags={"Gym"},
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
     *         @OA\JsonContent(ref="#/components/schemas/GymUpdateRequest")
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
     *                                 @OA\Schema(ref="#/components/schemas/GymTransformer")
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
     * @param GymUpdateRequest $request
     *
     * @return JsonResponse
     *
     * @throws AuthorizationException
     */
    public function update(int $id, GymUpdateRequest $request): JsonResponse
    {
        $model = $this->gymRepository->getById($id);

        $this->authorize('update', $model);

        abort_if(null === $model, 404, 'Not found.');

        $model = $this->gymService->update($model, $request->validated());

        return Response::success(new GymTransformer($model));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/gym/list/own",
     *     description="List gym.",
     *     tags={"Gym"},
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
     *                             type="array",
     *                             @OA\Items(ref="#/components/schemas/GymTransformer")
     *                         )
     *                     ),
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param GymUpdateRequest $request
     *
     * @return JsonResponse
     */
    public function listOwn(Request $request): JsonResponse
    {
        return Response::success(new GymTransformer($request->user()->gyms));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/gym/trainer/add",
     *     description="Trainer add.",
     *     tags={"Gym"},
     *     security={
     *         {"bearerAuth" : {}}
     *     },
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/TrainerAddRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 allOf={
     *                     @OA\Schema(ref="#/components/schemas/Response"),
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param TrainerAddRequest $request
     *
     * @return JsonResponse
     */
    public function trainerAdd(TrainerAddRequest $request): JsonResponse
    {
        $this->gymService->trainerAdd($request->validated());

        return Response::success();
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/gym/trainer/remove",
     *     description="Trainer remove.",
     *     tags={"Gym"},
     *     security={
     *         {"bearerAuth" : {}}
     *     },
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/TrainerRemoveRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 allOf={
     *                     @OA\Schema(ref="#/components/schemas/Response"),
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param TrainerRemoveRequest $request
     *
     * @return JsonResponse
     */
    public function trainerRemove(TrainerRemoveRequest $request): JsonResponse
    {
        $this->gymService->trainerRemove($request->validated());

        return Response::success();
    }

    /**
     * @OA\Post(
     *     path="/api/v1/gym/manager/add",
     *     description="Manager add.",
     *     tags={"Gym"},
     *     security={
     *         {"bearerAuth" : {}}
     *     },
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/ManagerAddRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 allOf={
     *                     @OA\Schema(ref="#/components/schemas/Response"),
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param ManagerAddRequest $request
     *
     * @return JsonResponse
     */
    public function managerAdd(ManagerAddRequest $request): JsonResponse
    {
        $this->gymService->managerAdd($request->validated());

        return Response::success();
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/gym/manager/remove",
     *     description="Manager remove.",
     *     tags={"Gym"},
     *     security={
     *         {"bearerAuth" : {}}
     *     },
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/ManagerRemoveRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 allOf={
     *                     @OA\Schema(ref="#/components/schemas/Response"),
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param ManagerRemoveRequest $request
     *
     * @return JsonResponse
     */
    public function managerRemove(ManagerRemoveRequest $request): JsonResponse
    {
        $this->gymService->managerRemove($request->validated());

        return Response::success();
    }
}
