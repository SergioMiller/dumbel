<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GymController;
use App\Http\Controllers\Api\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/account', [AccountController::class, 'get']);
    Route::put('/account', [AccountController::class, 'update']);
    Route::post('/gym/create', [GymController::class, 'create']);
    Route::get('/gym/{id}', [GymController::class, 'get']);
    Route::put('/gym/{id}/update', [GymController::class, 'update']);
    Route::get('/gym/list/own', [GymController::class, 'list']);

    Route::post('/subscription/create', [SubscriptionController::class, 'create']);
    Route::get('/subscription/{id}', [SubscriptionController::class, 'get']);
    Route::put('/subscription/{id}/update', [SubscriptionController::class, 'update']);
    Route::get('/subscription/{gym_id}/list', [SubscriptionController::class, 'listByGym']);
});
