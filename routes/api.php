<?php
declare(strict_types=1);

use App\Http\Controllers\Api\BarcodeController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GymController;
use App\Http\Controllers\Api\GymMembershipController;
use App\Http\Controllers\Api\TrainingController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\HasGymAccessMiddleware;
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
    Route::get('/gym/list/own', [GymController::class, 'listOwn']);

    Route::middleware(HasGymAccessMiddleware::class)->group(function () {
        Route::put('/gym/{id}', [GymController::class, 'update']);

        Route::post('/gym/employee', [GymController::class, 'employeeAdd']);
        Route::delete('/gym/employee', [GymController::class, 'employeeRemove']);
    });

    Route::post('/gym-membership/create', [GymMembershipController::class, 'create']);
    Route::get('/gym-membership/{id}', [GymMembershipController::class, 'get']);
    Route::put('/gym-membership/{id}', [GymMembershipController::class, 'update']);
    Route::get('/gym-membership/{gym_id}/list', [GymMembershipController::class, 'listByGym']);
    Route::post('/gym-membership/attach', [GymMembershipController::class, 'gymMembershipAttach']);
    Route::get('/gym-membership/active', [GymMembershipController::class, 'gymMembershipActive']);
    Route::post('/gym-membership/freeze', [GymMembershipController::class, 'freeze']);

    Route::post('/user/create', [UserController::class, 'create']);
    Route::get('/user/{barcode}', [UserController::class, 'getByBarcode'])->middleware(HasGymAccessMiddleware::class);

    Route::post('/training', [TrainingController::class, 'create'])->middleware(HasGymAccessMiddleware::class);
});
