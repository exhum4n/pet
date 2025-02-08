<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole
{
    case administrator;
    case moderator;
    case gamer;
}
