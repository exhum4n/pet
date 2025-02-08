<?php

declare(strict_types=1);

namespace App\Services\Game\Item;

use App\Models\Game\Game;
use App\Models\Game\Item\Category;
use App\Repositories\Game\Item\CategoryRepository;
use Illuminate\Support\Collection;

final readonly class CategoryService
{
    public function __construct(public CategoryRepository $categories)
    {
    }

    public function create(Game $game, string $name): Category
    {
        return $this->categories->create([
            'game_id' => $game->id,
            'name' => $name,
        ]);
    }

    public function getByGame(Game $game): Collection
    {
        return $this->categories->get([
            'game_id' => $game->id,
        ]);
    }
}
