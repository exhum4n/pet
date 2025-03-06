<?php

namespace App\Providers;

use App\Exceptions\Handler;
use App\Http\Middlewares\Authenticate;
use App\Http\Validators\Enum;
use App\Http\Validators\Uuid;
use App\Models\Auth\PersonalAccessToken;
use App\Models\Gamer\Game as GamerGame;
use App\Models\Policies\Gamer\GamePolicy as GamerGamePolicy;
use Illuminate\Auth\Middleware\Authenticate as BaseAuthenticate;
use Illuminate\Foundation\Exceptions\Handler as BaseHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseAuthenticate::class, Authenticate::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        $this->replaceExceptionHandler();
        $this->registerValidators();
        $this->definePolicies();
    }

    private function replaceExceptionHandler(): void
    {
        $this->app->bind(BaseHandler::class, Handler::class);
    }

    private function registerValidators(): void
    {
        Validator::extend('enum', Enum::class);
        Validator::extend('uuid', Uuid::class);
    }

    private function definePolicies(): void
    {
        Gate::policy(GamerGame::class, GamerGamePolicy::class);
    }
}
