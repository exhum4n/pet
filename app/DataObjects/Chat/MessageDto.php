<?php

declare(strict_types=1);

namespace App\DataObjects\Chat;

use App\DataObjects\DataObject;

class MessageDto extends DataObject
{
    public string $message;
    public string|null $file = null;
    public string|null $filename = null;
}
