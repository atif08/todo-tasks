<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TwoFactorAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register.user');
//    Route::post('/register/guest', 'register')->name('register.guest');
    Route::post('login', 'login')->name('user.login');
});

Route::post('verify-code', TwoFactorAuthController::class)->name('code.verify');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::apiResource('/tasks', TaskController::class);
    Route::delete('logout', [AuthController::class,'logout'])->name('user.logout');
});
