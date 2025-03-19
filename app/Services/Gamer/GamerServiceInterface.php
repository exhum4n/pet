<?php

declare(strict_types=1);

namespace App\Services\Gamer;

use App\DataObjects\GamerData;
use App\Models\Auth\User;
use App\Models\Gamer\Gamer;

interface GamerServiceInterface
{
    public function register(User $user, GamerData $data): Gamer;
}
