<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Game\GameService;
use App\Services\Game\GameServiceInterface;
use App\Services\Game\Item\CategoryService;
use App\Services\Game\Item\CategoryServiceInterface;
use App\Services\Game\ServerService;
use App\Services\Game\ServerServiceInterface;
use Illuminate\Support\ServiceProvider;

class GameServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(GameServiceInterface::class, GameService::class);
        $this->app->bind(ServerServiceInterface::class, ServerService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
    }

    public function boot(): void
    {
    }
}
