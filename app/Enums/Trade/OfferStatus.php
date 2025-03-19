<?php

declare(strict_types=1);

namespace App\Enums\Trade;

enum OfferStatus
{
    case waiting;
    case accepted;
    case rejected;
    case completed;
}
