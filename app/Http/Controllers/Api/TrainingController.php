<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Training\TrainingCreateRequest;
use App\Library\Response;
use App\Repository\TrainingRepository;
use App\Services\Api\Training\Dto\TrainingAddDto;
use App\Services\Api\Training\TrainingService;
use App\Http\Transformers\Training\TrainingTransformer;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

final class TrainingController extends Controller
{
    public function __construct(
        private readonly TrainingService $trainingService,
        private readonly TrainingRepository $trainingRepository
    ) {
    }

    /**
     * @OA\Post(
     *     path="/api/v1/training",
     *     description="Training create.",
     *     tags={"Training"},
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
     *         @OA\JsonContent(ref="#/components/schemas/TrainingCreateRequest")
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
     * @param TrainingCreateRequest $request
     *
     * @return JsonResponse
     */
    public function create(TrainingCreateRequest $request): JsonResponse
    {
        $data = TrainingAddDto::fromArray(array_merge($request->validated(), [
            'gym_id' => (int) $request->header('authorization-gym-id'),
            'manager_id' => $request->user()->id
        ]));

        $this->trainingService->create($data);

        return Response::success();
    }

    /**
     * @OA\Get(
     *     path="/api/v1/training/{id}",
     *     description="Training get.",
     *     tags={"Training"},
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
     *                                 @OA\Schema(ref="#/components/schemas/TrainingTransformer")
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
        $entity = $this->trainingRepository->getById($id);

        abort_if(null === $entity, 404);

        return Response::success(new TrainingTransformer($entity));
    }
}
