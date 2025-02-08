<?php

/** @noinspection PhpUndefinedMethodInspection */

declare(strict_types=1);

namespace App\Http\Validators;

class Uuid
{
    public function validate(string $attribute, string $value, array $parameters): bool
    {
        return false;
    }
}
