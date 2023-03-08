<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GymController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SwaggerController;
use App\Http\Controllers\Admin\SubscriptionController;
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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class)->except('show')->parameter('user', 'id');
    Route::resource('gym', GymController::class)->except('show')->parameter('user', 'id');
    Route::get('/gym/subscription/{id}', [SubscriptionController::class, 'edit'])->name('subscription.edit');
    Route::put('/gym/subscription/{id}', [SubscriptionController::class, 'update'])->name('subscription.update');
});