<?php

declare(strict_types=1);

namespace App\Repositories\Gamer;

use App\Models\Game\Game;
use App\Models\Gamer\Game as GamerGame;
use App\Models\Gamer\Gamer;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Collection;

class GameRepository extends EloquentRepository
{
    /**
     * @param Gamer $gamer
     *
     * @return Collection<Game>
     */
    public function getByGamer(Gamer $gamer): Collection
    {
        $query = Game::query();

        $query->join('gamers.games', 'gamers.games.game_id', '=', 'games.games.id');

        $query->where('gamers.games.gamer_id', $gamer->id);

        $query->select([
            'games.games.id',
            'gamers.games.id as gamer_game_id',
            'games.games.name',
            'games.games.image_url',
            'gamers.games.now_playing',
        ]);

        return $query->get();
    }

    protected function getModel(): string
    {
        return GamerGame::class;
    }
}
