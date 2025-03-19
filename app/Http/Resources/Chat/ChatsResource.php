<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\JsonResource;
use App\Models\Chat\Chat;
use Illuminate\Support\Collection;

/**
 * @property Collection<Chat> $resource
 */
class ChatsResource extends JsonResource
{
}
