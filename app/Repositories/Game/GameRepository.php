<?php

/** @noinspection PhpIncompatibleReturnTypeInspection */

declare(strict_types=1);

namespace App\Repositories\Game;

use App\Models\Game\Game;
use App\Repositories\EloquentRepository;

class GameRepository extends EloquentRepository
{
    protected function getModel(): string
    {
        return Game::class;
    }
}
