<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Training\TrainingCreateRequest;
use App\Library\Response;
use App\Services\Api\Training\Dto\TrainingAddDto;
use App\Services\Api\Training\TrainingService;
use App\Http\Transformers\Training\TrainingTransformer;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

final class TrainingController extends Controller
{
    public function __construct(private readonly TrainingService $trainingService)
    {
    }

    /**
     * @OA\Post(
     *     path="/api/v1/training",
     *     description="Training create.",
     *     tags={"Training"},
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/TrainingCreateRequest")
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

        $model = $this->trainingService->create($data);

        return Response::success(new TrainingTransformer($model));
    }
}
