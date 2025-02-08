<?php

declare(strict_types=1);

namespace App\Models\Policies;

use App\Models\Auth\User;
use App\Models\Game\Game;

class GamePolicy extends Policy
{
    public function index(User $user): bool
    {
        return true;
    }

    public function show(User $user, Game $game): bool
    {
        return true;
    }

    public function store(User $user): bool
    {
        return $this->isAdministrator($user);
    }

    public function update(User $user, Game $game): bool
    {
        return $this->isAdministrator($user);
    }

    public function destroy(User $user, Game $game): bool
    {
        return $this->isAdministrator($user);
    }
}
