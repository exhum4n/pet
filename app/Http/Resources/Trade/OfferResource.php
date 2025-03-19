<?php

declare(strict_types=1);

namespace App\Http\Resources\Trade;

use App\Http\Resources\JsonResource;
use App\Models\Trade\Offer;
use Illuminate\Http\Request;

/**
 * @property Offer $resource
 */
class OfferResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return ['id' => $this->resource->id];
    }
}
