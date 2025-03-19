<?php

declare(strict_types=1);

namespace App\Services\Game;

use App\Models\Game\Game;
use App\Models\Game\Server;
use App\Repositories\Game\ServerRepository;
use App\Exceptions\AlreadyDoneException;
use Illuminate\Support\Str;

final readonly class ServerService implements ServerServiceInterface
{
    public function __construct(public ServerRepository $servers)
    {
    }

    /**
     * @throws AlreadyDoneException
     */
    public function create(Game $game, string $name): Server
    {
        $serverData = [
            'game_id' => $game->id,
            'name' => Str::ucfirst($name)
        ];

        if ($this->servers->getFirst($serverData)) {
            throw new AlreadyDoneException('server_already_exists');
        }

        return $this->servers->create($serverData);
    }

    public function update(Server $server, string $name): Server
    {
        return $this->servers->update($server, [
            'name' => Str::ucfirst($name)
        ]);
    }
}
