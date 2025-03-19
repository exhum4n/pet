<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Gamer\AvatarService;
use App\Services\Gamer\AvatarServiceInterface;
use App\Services\Gamer\GamerService;
use App\Services\Gamer\GamerServiceInterface;
use App\Services\Gamer\GameService;
use App\Services\Gamer\GameServiceInterface;
use App\Services\Gamer\ItemService;
use App\Services\Gamer\ItemServiceInterface;
use Illuminate\Support\ServiceProvider;

class GamerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AvatarServiceInterface::class, AvatarService::class);
        $this->app->bind(GamerServiceInterface::class, GamerService::class);
        $this->app->bind(GameServiceInterface::class, GameService::class);
        $this->app->bind(ItemServiceInterface::class, ItemService::class);
    }

    public function boot(): void
    {
    }
}
