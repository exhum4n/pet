<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\Auth\User;

interface UserServiceInterface
{
    public function create(string $email, ?string $password = null): User;

    public function updatePassword(User $user, string $newPassword): User;
}
