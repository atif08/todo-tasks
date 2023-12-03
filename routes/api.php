<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegisterController;
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


Route::post('login', [AuthController::class,'login'])->name('login.user');
Route::post('register', RegisterController::class)->name('register.user');
Route::post('verify-code', TwoFactorAuthController::class)->name('code.verify');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::apiResource('/tasks', TaskController::class);
    Route::delete('logout', [AuthController::class,'logout'])->name('user.logout');
});
