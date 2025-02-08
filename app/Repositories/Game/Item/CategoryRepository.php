<?php

declare(strict_types=1);

namespace App\Repositories\Game\Item;

use App\Models\Game\Item\Category;
use App\Repositories\EloquentRepository;

class CategoryRepository extends EloquentRepository
{
    protected function getModel(): string
    {
        return Category::class;
    }
}
