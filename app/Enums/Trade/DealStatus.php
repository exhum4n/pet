<?php

declare(strict_types=1);

namespace App\Enums\Trade;

enum DealStatus
{
    case in_process;
    case completed;
    case aborted;
}
