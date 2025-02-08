<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;
use Symfony\Component\HttpFoundation\Response as Code;

class EntityNotFoundException extends Exception
{
    public function __construct(string $message = "entity_not_found", ?Throwable $previous = null)
    {
        parent::__construct($message, Code::HTTP_NOT_FOUND, $previous);
    }
}
