<?php

declare(strict_types=1);

namespace App\Models\Policies;

use App\Enums\UserRole;
use App\Models\Auth\User;

abstract class Policy
{
    protected function isAdministrator(User $user): bool
    {
        return $user->role === UserRole::administrator->name;
    }

    protected function isModerator(User $user): bool
    {
        return $user->role === UserRole::moderator->name;
    }
}
