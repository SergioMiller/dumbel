<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GymController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\UserController;
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
Route::post('/auth/register/check-qr-code', [AuthController::class, 'checkQrCode']);
Route::get('/auth/get-user/{uuid}', [AuthController::class, 'getUserByQrCode'])->where('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
Route::post('/auth/register/{uuid}', [AuthController::class, 'registerWithQrCode'])->where('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/account', [AccountController::class, 'get']);
    Route::put('/account', [AccountController::class, 'update']);
    Route::post('/gym/create', [GymController::class, 'create']);
    Route::get('/gym/{id}', [GymController::class, 'get']);
    Route::put('/gym/{id}/update', [GymController::class, 'update']);
    Route::get('/gym/list/own', [GymController::class, 'listOwn']);

    Route::post('/gym/trainer/add', [GymController::class, 'trainerAdd']);
    Route::delete('/gym/trainer/remove', [GymController::class, 'trainerRemove']);
    Route::post('/gym/manager/add', [GymController::class, 'managerAdd']);
    Route::delete('/gym/manager/remove', [GymController::class, 'managerRemove']);

    Route::post('/subscription/create', [SubscriptionController::class, 'create']);
    Route::get('/subscription/{id}', [SubscriptionController::class, 'get']);
    Route::put('/subscription/{id}/update', [SubscriptionController::class, 'update']);
    Route::get('/subscription/{gym_id}/list', [SubscriptionController::class, 'listByGym']);

    Route::post('/user/create', [UserController::class, 'create']);
});
