<?php

declare(strict_types=1);

namespace App\Repositories\Chat;

use App\Models\Chat\Message;
use App\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class MessageRepository extends EloquentRepository
{
    public function getByChatId(string $chatId, int $count): Collection
    {
        $query = $this->getMessagesQuery($chatId);

        return $query->limit($count)->get();
    }

    public function getFromMessage(Message $message, int $count): Collection
    {
        $query = $this->getMessagesQuery($message->chat_id);

        $query->where('chats.messages.created_at', '<', $message->created_at);

        return $query->limit($count)->get();
    }

    protected function getModel(): string
    {
        return Message::class;
    }

    private function getMessagesQuery(string $chatId): Builder
    {
        $query = $this->getQuery();

        $query->join('gamers.gamers', 'gamers.gamers.id', '=', 'chats.messages.gamer_id');

        $query->where(['chat_id' => $chatId]);

        $query->select([
            'messages.id',
            'messages.gamer_id',
            'gamers.username',
            'gamers.tag',
            'messages.type',
            'messages.content',
            'messages.created_at',
        ]);

        $query->orderBy('messages.created_at', 'desc');

        return $query;
    }
}
