<?php
declare(strict_types=1);

use App\Http\Controllers\Api\BarcodeController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GymController;
use App\Http\Controllers\Api\GymMembershipController;
use App\Http\Controllers\Api\UserController;
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

Route::get('/barcode/{id}', [BarcodeController::class, 'barcode'])->name('api.barcode.get');

Route::group(['middleware' => ['auth:sanctum']], static function () {
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

    Route::post('/gym-membership/create', [GymMembershipController::class, 'create']);
    Route::get('/gym-membership/{id}', [GymMembershipController::class, 'get']);
    Route::put('/gym-membership/{id}/update', [GymMembershipController::class, 'update']);
    Route::get('/gym-membership/{gym_id}/list', [GymMembershipController::class, 'listByGym']);
    Route::post('/gym-membership/attach', [GymMembershipController::class, 'gymMembershipAttach']);
    Route::get('/gym-membership/active', [GymMembershipController::class, 'gymMembershipActive']);
    Route::post('/gym-membership/freeze', [GymMembershipController::class, 'freeze']);

    Route::post('/user/create', [UserController::class, 'create']);
});
