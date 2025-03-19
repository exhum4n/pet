<?php

declare(strict_types=1);

namespace App\Models\Policies\Gamer;

use App\Models\Auth\User;
use App\Models\Gamer\Item;
use App\Models\Policies\Policy;

class ItemPolicy extends Policy
{
    public function offer(User $user, Item $item): bool
    {
        if ($this->isOwner($user, $item) === true) {
            return false;
        }

        return true;
    }

    private function isOwner(User $user, Item $item): bool
    {
        return $user->gamer->id === $item->gamer_id;
    }
}
