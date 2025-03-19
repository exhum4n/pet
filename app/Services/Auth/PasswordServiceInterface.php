<?php

declare(strict_types=1);

namespace App\Services\Auth;

use Illuminate\Contracts\Auth\Authenticatable;

interface PasswordServiceInterface
{
    public function sendRequest(string $email): void;

    public function change(Authenticatable $user, string $code, $password): void;
}
