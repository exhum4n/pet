<?php

declare(strict_types=1);

namespace App\DataObjects\Gamer;

use App\DataObjects\DataObject;

class FilterData extends DataObject
{
    public string|null $service_id;
}
