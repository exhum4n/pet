<?php

declare(strict_types=1);

namespace App\Services\Game;

use App\Models\Game\Game;
use App\Models\Game\Server;

interface ServerServiceInterface
{
    public function create(Game $game, string $name): Server;

    public function update(Server $server, string $name): Server;
}
