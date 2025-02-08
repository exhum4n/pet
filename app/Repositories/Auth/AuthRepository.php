<?php

declare(strict_types=1);

namespace App\Repositories\Auth;

use App\Repositories\RedisRepository;

class AuthRepository extends RedisRepository
{
    protected string $prefix = 'auth_fails';
    protected int $expirationTime = 600;

    public function setFailAttempts(string $email, int $count): void
    {
        $this->set($email, $count);
    }

    public function getFailsCount(string $email): ?int
    {
        $count = $this->get($email) ?? 0;

        return (int) $count;
    }
}
