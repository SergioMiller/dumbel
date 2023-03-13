<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Account\AccountUpdateRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Library\Response;
use App\Repository\GymMembershipRepository;
use App\Transformers\Account\AccountActiveGymMembershipTransformer;
use App\Transformers\Account\AccountTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;

final class AccountController extends Controller
{
    public function __construct(private readonly GymMembershipRepository $gymMembershipRepository)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/v1/account",
     *     description="Return account.",
     *     tags={"Account"},
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
     *                                 @OA\Schema(ref="#/components/schemas/AccountTransformer")
     *                             }
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @param LoginRequest $request
     */
    public function get(Request $request): JsonResponse
    {
        return Response::success(new AccountTransformer($request->user()));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/account",
     *     description="Update account.",
     *     tags={"Account"},
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/AccountUpdateRequest")
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
     *                                 @OA\Schema(ref="#/components/schemas/AccountTransformer")
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
    public function update(AccountUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $request->user()->update($data);

        return Response::success(new AccountTransformer($request->user()->fresh()));
    }

    public function activeGymMemberships(Request $request): JsonResponse
    {
        $activeGymMembership = $this->gymMembershipRepository->getActiveForUser($request->user()->id);

        return Response::success(new AccountActiveGymMembershipTransformer($activeGymMembership));
    }
}
