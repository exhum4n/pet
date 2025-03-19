<?php

declare(strict_types=1);

namespace App\Services\Gamer;

use App\Models\Gamer\Item;
use App\Repositories\Gamer\ItemRepository;

final readonly class ItemService implements ItemServiceInterface
{
    public function __construct(public ItemRepository $items)
    {
    }

    public function delete(Item $item): void
    {
        $this->items->deleteByModel($item);
    }
}
