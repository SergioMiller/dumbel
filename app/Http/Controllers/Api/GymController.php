<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Gym\GymCreateRequest;
use App\Http\Requests\Api\Gym\GymUpdateRequest;
use App\Library\Response;
use App\Models\Gym;
use App\Services\GymService;
use App\Transformers\GymTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GymController extends Controller
{
    private GymService $gymService;

    public function __construct(GymService $gymService)
    {
        $this->gymService = $gymService;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/gym/create",
     *     description="Create gym.",
     *     tags={"Gym"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/RequestGymCreate")
     *     ),
     *     security={
     *          {"bearerAuth": {}}
     *      },
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
     *                                 @OA\Schema(ref="#/components/schemas/ResponseGym")
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
     * @OA\Put(
     *     path="/api/v1/gym/{id}/update",
     *     description="Update gym.",
     *     tags={"Gym"},
     *     security={
     *          {"bearerAuth": {}}
     *      },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="int")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/RequestGymUpdate")
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
     *                                 @OA\Schema(ref="#/components/schemas/ResponseGym")
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
     */
    public function update(int $id, GymUpdateRequest $request): JsonResponse
    {
        /** @var Gym $gym */
        $gym = Gym::query()->where('id', $id)->where('user_id', $request->user()->id)->first();

        abort_if($gym === null, 404, 'Not found.');

        $gym = $this->gymService->update($gym, $request->validated());

        return Response::success(new GymTransformer($gym));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/gym/list/own",
     *     description="List gym.",
     *     tags={"Gym"},
     *     security={
     *          {"bearerAuth": {}}
     *      },
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
     *                             @OA\Items(ref="#/components/schemas/ResponseGym")
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
    public function list(Request $request): JsonResponse
    {
        return Response::success(new GymTransformer($request->user()->gyms));
    }
}
