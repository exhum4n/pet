<?php

declare(strict_types=1);

namespace App\Repositories\Gamer;

use App\Models\Gamer\Item;
use App\Repositories\EloquentRepository;

class ItemRepository extends EloquentRepository
{
    protected function getModel(): string
    {
        return Item::class;
    }
}
