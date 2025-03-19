<?php

declare(strict_types=1);

namespace App\DataObjects\Trade;

use App\DataObjects\DataObject;

class TradeFilter extends DataObject
{
    public string|null $server_id = null;
    public string|null $category_id = null;
    public string|null $name = null;
}
