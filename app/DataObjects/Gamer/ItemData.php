<?php

declare(strict_types=1);

namespace App\DataObjects\Gamer;

use App\DataObjects\DataObject;

class ItemData extends DataObject
{
    public string $server_id;
    public string $name;
    public string $description;
    public string $category;
    public int $count;
    public int $price;
}
