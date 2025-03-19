<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\Auth\User;

interface RegistrationServiceInterface
{
    public function attempt(string $email): void;

    public function complete(string $email, string $password, string $code): User;
}
