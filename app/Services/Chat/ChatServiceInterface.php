<?php

declare(strict_types=1);

namespace App\Services\Chat;

use App\Models\Chat\Chat;
use App\Models\Gamer\Gamer;
use App\Repositories\Chat\ChatRepository;
use App\Repositories\Chat\MemberRepository;

/**
 * @property ChatRepository $chats
 * @property MemberRepository $members
 */
interface ChatServiceInterface
{
    public function publish(Gamer $gamer, Chat $chat, string $content): void;
}
