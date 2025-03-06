<?php

declare(strict_types=1);

namespace App\Http\Resources\Gamer;

use App\Http\Resources\JsonResource;
use Illuminate\Http\Request;

class GameResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
        ];
    }
}
