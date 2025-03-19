<?php

namespace App\Http\Resources\Chat;

use App\Models\Chat\Message;
use App\Http\Resources\JsonResource;
use Illuminate\Support\Collection;

/**
 * @property Collection<Message> $resource
 */
class MessagesResource extends JsonResource
{
}
