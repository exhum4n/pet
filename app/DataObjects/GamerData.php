<?php

declare(strict_types=1);

namespace App\DataObjects;

class GamerData extends DataObject
{
    public string $username;
    public string $gender;
    public string $birthday;
    public string $timezone;
    public array $languages;
}
