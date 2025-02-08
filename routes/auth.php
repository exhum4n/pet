<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\UserController;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::post('registration', [RegistrationController::class, 'attempt']);
    Route::put('registration', [RegistrationController::class, 'register']);

    Route::post('password', [PasswordController::class, 'attempt']);
    Route::put('password', [PasswordController::class, 'change'])->name('password.change');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('logout/all', [AuthController::class, 'logoutAll']);
    });
});
