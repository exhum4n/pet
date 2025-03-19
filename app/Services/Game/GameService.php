<?php

declare(strict_types=1);

namespace App\Services\Game;

use App\Repositories\Game\GameRepository;

final readonly class GameService implements GameServiceInterface
{
    public function __construct(public GameRepository $games)
    {
    }

    protected function repository(): string
    {
        return GameRepository::class;
    }
}
