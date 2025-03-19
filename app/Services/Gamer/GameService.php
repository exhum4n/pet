<?php

declare(strict_types=1);

namespace App\Services\Gamer;

use App\Models\Gamer\Game as GamerGame;
use App\Models\Game\Game;
use App\Models\Gamer\Gamer;
use App\Repositories\Gamer\GameRepository;

final readonly class GameService implements GameServiceInterface
{
    public function __construct(public GameRepository $games)
    {
    }

    public function create(Gamer $gamer, Game $game, ?bool $nowPlaying = null): GamerGame
    {
        $gameData = [
            'gamer_id' => $gamer->id,
            'game_id' => $game->id,
        ];

        $existsGame = $this->games->getFirst($gameData);
        if ($existsGame) {
            return $existsGame;
        }

        return $this->games->create($gameData);
    }
}
