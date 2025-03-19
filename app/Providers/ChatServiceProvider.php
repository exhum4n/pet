<?php

declare(strict_types=1);

namespace App\Providers;

use App\Broadcasting\Centrifugo\CentrifugoClient;
use App\Broadcasting\Centrifugo\CentrifugoClientInterface;
use App\Broadcasting\Centrifugo\CentrifugoConfig;
use App\Services\Chat\ChatService;
use App\Services\Chat\ChatServiceInterface;
use App\Services\Chat\MessageService;
use App\Services\Chat\MessageServiceInterface;
use App\Services\Chat\TokenService;
use App\Services\Chat\TokenServiceInterface;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\ServiceProvider;

class ChatServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CentrifugoClientInterface::class, CentrifugoClient::class);
        $this->app->bind(ChatServiceInterface::class, ChatService::class);
        $this->app->bind(MessageServiceInterface::class, MessageService::class);
        $this->app->bind(TokenServiceInterface::class, TokenService::class);

        $this->app->singleton(CentrifugoClientInterface::class, function () {
            return new CentrifugoClient(
                new CentrifugoConfig(config('broadcasting.connections.centrifugo')),
                new HttpClient()
            );
        });
    }

    public function boot(): void
    {
    }
}
