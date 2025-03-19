<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Trade\OfferService;
use App\Services\Trade\OfferServiceInterface;
use App\Services\Trade\TradeService;
use App\Services\Trade\TradeServiceInterface;
use Illuminate\Support\ServiceProvider;

class TradeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OfferServiceInterface::class, OfferService::class);
        $this->app->bind(TradeServiceInterface::class, TradeService::class);
    }

    public function boot(): void
    {
    }
}
