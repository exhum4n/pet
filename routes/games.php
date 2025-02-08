<?php

declare(strict_types=1);

use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Game\Item\CategoryController;
use App\Http\Controllers\Game\ServerController;
use Illuminate\Support\Facades\Route;

Route::prefix('games')->group(function () {
    Route::delete('servers/{server}', [ServerController::class, 'destroy']);
    Route::delete('items/categories/{category}', [CategoryController::class, 'destroy']);

    Route::prefix('{game}')->group(function () {
        Route::get('items/categories', [CategoryController::class, 'index']);
        Route::post('items/categories', [CategoryController::class, 'store']);

        Route::resource('servers', ServerController::class)->only([
            'index', 'store'
        ]);
    });
});

Route::resource('games', GameController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
]);
