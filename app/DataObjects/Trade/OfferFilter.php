<?php

declare(strict_types=1);

namespace App\DataObjects\Trade;

use App\DataObjects\DataObject;

class OfferFilter extends DataObject
{
    public string|null $status = null;
}
