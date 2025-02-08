<?php

declare(strict_types=1);

namespace App\Repositories\Auth;

use App\Repositories\RedisRepository;

class OTPRepository extends RedisRepository
{
    protected string $prefix = 'otp';

    protected int $expirationTime = 600;

    public function make(string $key): string
    {
        $code = (string) rand(100000, 999999);

        $this->set($key, $code);

        return $code;
    }
}
