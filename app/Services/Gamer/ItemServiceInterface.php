<?php

declare(strict_types=1);

namespace App\Services\Gamer;

use App\Models\Gamer\Item;

interface ItemServiceInterface
{
    public function delete(Item $item): void;
}
