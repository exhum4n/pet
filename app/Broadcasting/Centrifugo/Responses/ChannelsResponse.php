<?php

declare(strict_types=1);

namespace App\Broadcasting\Centrifugo\Responses;

class ChannelsResponse extends Response
{
    public array $channels;
}
