<?php

declare(strict_types=1);

namespace App\Broadcasting\Centrifugo\Responses;

class HistoryResponse extends Response
{
    public array $publications;
}
