<?php

declare(strict_types=1);

use App\Http\Controllers\Gamer\AvatarController;
use App\Http\Controllers\Gamer\GameController;
use App\Http\Controllers\Gamer\GamerController;
use App\Http\Controllers\Gamer\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gamer\AuthController;

Route::prefix('gamers')->group(function () {
    Route::get('current', [AuthController::class, 'index']);
    Route::post('avatar', [AvatarController::class, 'update']);

    Route::resource('games', GameController::class)->only([
        'index', 'store', 'destroy'
    ]);

    Route::resource('items', ItemController::class)->only([
        'index', 'store', 'update', 'destroy'
    ]);
});

Route::resource('gamers', GamerController::class)->only([
    'index', 'show', 'store'
]);
