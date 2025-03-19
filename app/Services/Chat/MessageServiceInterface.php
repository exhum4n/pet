<?php

declare(strict_types=1);

namespace App\Services\Chat;

use App\DataObjects\Chat\MessageDto;
use App\Models\Chat\Chat;
use App\Models\Chat\Message;
use App\Models\Gamer\Gamer;
use Illuminate\Support\Collection;

interface MessageServiceInterface
{
    public function publish(Gamer $gamer, Chat $chat, MessageDto $messageDto): Message;
    public function list(Chat $chat, int $count): Collection;

    public function getFromMessage(Message $message, int $count): Collection;
}
