<?php

declare(strict_types=1);

namespace App\Services\Game\Item;

use App\Models\Game\Game;
use App\Models\Game\Item\Category;
use Illuminate\Support\Collection;

interface CategoryServiceInterface
{
    public function create(Game $game, string $name): Category;

    public function getByGame(Game $game): Collection;
}
