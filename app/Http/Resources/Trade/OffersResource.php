<?php

declare(strict_types=1);

namespace App\Http\Resources\Trade;

use App\Http\Resources\JsonResource;
use App\Models\Trade\Offer;
use Illuminate\Support\Collection;

/**
 * @property Collection<Offer> $resource
 */
class OffersResource extends JsonResource
{
}
