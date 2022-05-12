<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     description="Return a bearer token.",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/RequestLogin")
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
     *                                 @OA\Schema(ref="#/components/schemas/ResponseLogin")
     *                             }
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     )
     * )
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home');
    }
}
