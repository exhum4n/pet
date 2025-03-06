<?php

declare(strict_types=1);

namespace App\Enums;

enum Language: string
{
    case ru_RU = 'Русский';
    case en_US = 'English';
    case de_DE = 'Deutsch';
    case fr_FR = 'Français';
    case es_ES = 'Español';
    case pt_PT = 'Português';
}
