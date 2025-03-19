<?php

declare(strict_types=1);

namespace App\Models\Policies\Chat;

use App\Models\Auth\User;
use App\Models\Chat\Chat;
use App\Models\Gamer\Gamer;
use App\Models\Policies\Policy;

class ChatPolicy extends Policy
{
    public function getMessages(User $user, Chat $chat): bool
    {
        return $this->isGamerInChat($user->gamer, $chat);
    }

    public function showMessages(User $user, Chat $chat): bool
    {
        return $this->isGamerInChat($user->gamer, $chat);
    }

    public function publishMessage(User $user, Chat $chat): bool
    {
        return $this->isGamerInChat($user->gamer, $chat);
    }

    public function show(User $user, Chat $chat): bool
    {
        return $this->isGamerInChat($user->gamer, $chat);
    }

    private function isGamerInChat(Gamer $gamer, Chat $chat): bool
    {
        $gamers = $chat->gamers;
        if ($gamers->where('id', $gamer->id)->isEmpty()) {
            return false;
        }

        return true;
    }
}
