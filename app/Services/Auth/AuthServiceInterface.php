<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\Auth\User;

interface AuthServiceInterface
{
    public function byPassword(User $user, string $password): User;
}
