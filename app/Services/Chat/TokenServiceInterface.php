<?php

declare(strict_types=1);

namespace App\Services\Chat;

interface TokenServiceInterface
{
    public function getToken(string $gamerId): string;
}
