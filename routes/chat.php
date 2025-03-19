<?php

declare(strict_types=1);

use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Chat\MessageController;
use App\Http\Controllers\Chat\TokenController;
use Illuminate\Support\Facades\Route;

Route::prefix('chat')->group(function () {
    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'index']);
        Route::post('/', [MessageController::class, 'store']);
        Route::get('{message_id}', [MessageController::class, 'show']);
    });

    Route::get('/', [ChatController::class, 'index']);
    Route::get('token', [TokenController::class, 'index']);
    Route::get('{chat_id}', [ChatController::class, 'show']);
});
