<?php
declare(strict_types=1);

use App\Http\Controllers\Admin\BarcodeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GymController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SwaggerController;
use App\Http\Controllers\Admin\GymMembershipController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', static function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], static function () {
    Route::get('/swagger', [SwaggerController::class, 'index'])->name('swagger');
    Route::get('/swagger/openapi.yaml', [SwaggerController::class, 'openapi'])->name('openapi');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('user', UserController::class)->except('show')->parameter('user', 'id');
    Route::get('/user/barcode/{id}', [UserController::class, 'barcode'])->name('user.barcode');

    Route::resource('gym', GymController::class)->except('show')->parameter('user', 'id');
    Route::get('/gym/gym-membership/{id}', [GymMembershipController::class, 'edit'])->name('gym-membership.edit');
    Route::put('/gym/gym-membership/{id}', [GymMembershipController::class, 'update'])->name('gym-membership.update');

    Route::get('/barcode', [BarcodeController::class, 'index'])->name('barcode.index');
});
