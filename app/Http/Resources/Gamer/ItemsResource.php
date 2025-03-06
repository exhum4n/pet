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
        return $this->resource->map(function (Item $item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'price' => $item->price,
                'category' => $item->category,
                'count' => $item->count,
                'server' => $item->server->name,
                'game' => $item->server->game->name,
                'created_at' => $item->created_at,
            ];
        })->groupBy(['game', 'server'])->toArray();
    }
}
