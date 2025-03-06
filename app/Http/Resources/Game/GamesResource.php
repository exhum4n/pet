<?php

declare(strict_types=1);

namespace App\Http\Resources\Game;

use App\Http\Resources\JsonResource;
use App\Models\Game\Game;
use Illuminate\Support\Collection;

/**
 * @property Collection<Game> $resource
 */
class GamesResource extends JsonResource
{
}
