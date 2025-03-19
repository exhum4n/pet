<?php

declare(strict_types=1);

namespace App\Repositories\Gamer;

use App\DataObjects\Gamer\GamerFilter;
use App\Models\Auth\User;
use App\Models\Gamer\Gamer;
use App\Exceptions\EntityNotFoundException;
use App\Repositories\EloquentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class GamerRepository extends EloquentRepository
{
    /**
     * @throws EntityNotFoundException
     */
    public function getByUserOrFail(User $user): Gamer
    {
        $gamer = $this->getByUser($user);
        if ($gamer === null) {
            throw new EntityNotFoundException();
        }

        return $gamer;
    }

    public function getByUser(User $user): Gamer|null
    {
        return $this->getFirst(['user_id' => $user->id]);
    }

    public function getList(?GamerFilter $filters = null): Collection
    {
        $query = $this->getQuery();

        $query->select('gamers.*');

        if ($filters === null) {
            return $query->get();
        }

        if ($filters->game !== null) {
            $query->join('gamers.games', 'gamers.games.gamer_id', '=', 'gamers.gamers.id');

            $query->where('gamers.games.game_id', $filters->game);
        }

        if ($filters->gender !== null) {
            $query->where('gamers.gamers.gender', $filters->gender);
        }

        if ($filters->timezone !== null) {
            $query->where('gamers.gamers.timezone', $filters->timezone);
        }

        if ($filters->language !== null) {
            $query->whereJsonContains('gamers.gamers.languages', $filters->language);
        }

        return $query->get();
    }

    protected function getModel(): string
    {
        return Gamer::class;
    }
}
