<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Enums\GymEmployeePositionEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Gym\GymCreateRequest;
use App\Http\Requests\Api\Gym\GymEmployeeRemoveRequest;
use App\Http\Requests\Api\Gym\GymUpdateRequest;
use App\Http\Requests\Api\Gym\GymEmployeeAddRequest;
use App\Library\Response;
use App\Repository\GymRepository;
use App\Services\Api\Gym\Dto\EmployeeRemoveDto;
use App\Services\Api\Gym\Dto\GymCreateDto;
use App\Services\Api\Gym\Dto\GymUpdateDto;
use App\Services\Api\Gym\Dto\EmployeeAddDto;
use App\Services\Api\Gym\GymService;
use App\Http\Transformers\Gym\GymTransformer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

final class GymController extends Controller
{
    public function __construct(
        private readonly GymService $gymService,
        private readonly GymRepository $gymRepository
    ) {
    }

    /**
     * @OA\Post(
     *     path="/api/v1/gym/create",
     *     description="Create gym.",
     *     tags={"Gym"},
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/GymCreateRequest")
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
        $entity = $this->gymService->create($request->user(), GymCreateDto::fromArray($request->validated()));

        return Response::success(new GymTransformer($entity));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/gym/{id}",
     *     description="Get gym.",
     *     tags={"Gym"},
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
        $entity = $this->gymRepository->getById($id);

        abort_if(null === $entity, 404);

        return Response::success(new GymTransformer($entity));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/gym/{id}",
     *     description="Update gym.",
     *     tags={"Gym"},
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
     *     @OA\Parameter(
     *         name="AUTHORIZATION-GYM-ID",
     *         in="header",
     *         required=true,
     *
     *         @OA\Schema(type="int")
     *     ),
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/GymUpdateRequest")
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
        $entity = $this->gymRepository->getById($id);

        $this->authorize('update', $entity);

        abort_if(null === $entity, 404, 'Not found.');

        $entity = $this->gymService->update($entity, GymUpdateDto::fromArray($request->validated()));

        return Response::success(new GymTransformer($entity));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/gym/list/own",
     *     description="List gym.",
     *     tags={"Gym"},
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
     *                             type="array",
     *
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
        $list = $this->gymRepository->getByUserId($request->user()->id);

        return Response::success(new GymTransformer($list));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/gym/employee",
     *     description="Emploee add.",
     *     tags={"Gym"},
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
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/GymEmployeeAddRequest")
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
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param GymEmployeeAddRequest $request
     *
     * @return JsonResponse
     */
    public function employeeAdd(GymEmployeeAddRequest $request): JsonResponse
    {
        $this->gymService->employeeAdd(
            (new EmployeeAddDto)
                ->setGymId((int) $request->header('authorization-gym-id'))
                ->setUserId($request->get('user_id'))
                ->setPosition(GymEmployeePositionEnum::from($request->get('position')))
        );

        return Response::success();
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/gym/emploee",
     *     description="Emploee remove.",
     *     tags={"Gym"},
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
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/GymEmployeeRemoveRequest")
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
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param GymEmployeeRemoveRequest $request
     *
     * @return JsonResponse
     */
    public function employeeRemove(GymEmployeeRemoveRequest $request): JsonResponse
    {
        $this->gymService->employeeRemove(
            (new EmployeeRemoveDto())
                ->setGymId((int) $request->header('authorization-gym-id'))
                ->setUserId($request->get('user_id'))
                ->setPosition(GymEmployeePositionEnum::from($request->get('position')))
        );

        return Response::success();
    }
}
