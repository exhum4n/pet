<?php

declare(strict_types=1);

namespace App\Repositories\Trade;

use App\Models\Trade\Deal;
use App\Repositories\EloquentRepository;

class DealRepository extends EloquentRepository
{
    protected function getModel(): string
    {
        return Deal::class;
    }
}
