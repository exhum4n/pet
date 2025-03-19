<?php

declare(strict_types=1);

namespace App\Http\Resources\Gamer;

use App\Http\Resources\JsonResource;
use App\Models\Gamer\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * @property Collection<Item> $resource
 */
class ItemsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return $this->resource->groupBy(['server.game.name', 'server.name', 'category.name'])->toArray();
    }
}
