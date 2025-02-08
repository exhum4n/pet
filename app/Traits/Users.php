<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Auth\User;
use App\Repositories\Auth\UserRepository;
use App\Services\Auth\UserService;

trait Users
{
    public function createUser(string $email, ?string $password = null): User
    {
        return app(UserService::class)
            ->create($email, $password);
    }

    public function getUserByEmailOrFail(string $email): ?User
    {
        return app(UserRepository::class)
            ->getByEmailOrFail($email);
    }
}
