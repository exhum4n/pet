<?php

declare(strict_types=1);

namespace App\DataObjects\Gamer;

use App\DataObjects\DataObject;

class ServiceData extends DataObject
{
    public string $title;
    public string $description;
    public bool $is_free;
    public string $currency;
    public int $price;
}
