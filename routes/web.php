<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GymController;
use App\Http\Controllers\Admin\QrCodeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SwaggerController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/swagger', [SwaggerController::class, 'index'])->name('swagger');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class)->except('show')->parameter('user', 'id');
    Route::resource('gym', GymController::class)->except('show')->parameter('user', 'id');
    Route::get('/qr-code', [QrCodeController::class, 'index'])->name('qr-code.index');
});