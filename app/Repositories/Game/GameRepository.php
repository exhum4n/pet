<?php

/** @noinspection PhpIncompatibleReturnTypeInspection */

declare(strict_types=1);

namespace App\Repositories\Game;

use App\DataObjects\Game\FilterData;
use App\Models\Game\Game;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Collection;

class GameRepository extends EloquentRepository
{
    public function getFiltered(?FilterData $filter = null): Collection
    {
        $query = $this->getQuery();

        if ($filter !== null && strlen($filter->name) > 2) {
            $query->where('name', 'LIKE', $filter->name . '%');
        }

        return $query->get();
    }

    public function getWithRelations(array $relations): Collection
    {
        return $this->getQuery()->with($relations)->get();
    }

    protected function getModel(): string
    {
        return Game::class;
    }
}
