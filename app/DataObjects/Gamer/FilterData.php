<?php

declare(strict_types=1);

namespace App\DataObjects\Gamer;

use App\DataObjects\DataObject;

class FilterData extends DataObject
{
    public string|null $gender;
    public string|null $timezone = null;
    public string|null $language = null;
    public string|null $game = null;
}
