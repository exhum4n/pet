<?php

declare(strict_types=1);

namespace App\Models\Policies\Gamer;

use App\Models\Auth\User;
use App\Models\Gamer\Game;
use App\Models\Policies\Policy;

class GamePolicy extends Policy
{
    public function destroy(User $user, Game $game): bool
    {
        return $this->isOwner($user, $game);
    }

    public function isOwner(User $user, Game $game): bool
    {
        return $user->gamer->id === $game->gamer_id;
    }
}
