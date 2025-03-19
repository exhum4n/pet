<?php

declare(strict_types=1);

namespace App\Services\Gamer;

use App\Models\Game\Game;
use App\Models\Gamer\Game as GamerGame;
use App\Models\Gamer\Gamer;

interface GameServiceInterface
{
    public function create(Gamer $gamer, Game $game, ?bool $nowPlaying = null): GamerGame;
}
