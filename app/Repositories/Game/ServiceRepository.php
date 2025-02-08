<?php

declare(strict_types=1);

namespace App\Repositories\Game;

use App\Models\Game\Service;
use App\Repositories\EloquentRepository;

class ServiceRepository extends EloquentRepository
{
    protected function getModel(): string
    {
        return Service::class;
    }
}
