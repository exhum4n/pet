<?php

declare(strict_types=1);

use App\Http\Controllers\Trade\OfferController;
use App\Http\Controllers\Trade\TradeController;
use Illuminate\Support\Facades\Route;

Route::prefix('trade')->group(function () {
    Route::get('items', [TradeController::class, 'index']);

    Route::prefix('offers')->group(function () {
        Route::get('/', [OfferController::class, 'index']);
        Route::post('/', [TradeController::class, 'offer']);
        Route::put('{offer_id}', [TradeController::class, 'accept']);
        Route::patch('{offer_id}', [TradeController::class, 'reject']);
    });
});
