<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;
use Symfony\Component\HttpFoundation\Response as Code;

class AlreadyDoneException extends Exception
{
    public function __construct(string $message = "Actions is already done", ?Throwable $previous = null)
    {
        parent::__construct($message, Code::HTTP_FORBIDDEN, $previous);
    }
}
