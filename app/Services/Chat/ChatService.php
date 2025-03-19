<?php

declare(strict_types=1);

namespace App\Services\Chat;

use App\Jobs\Chat\PublishMessageJob;
use App\Models\Chat\Chat;
use App\Models\Gamer\Gamer;
use App\Repositories\Chat\ChatRepository;
use App\Repositories\Chat\MemberRepository;
use App\Repositories\Chat\MessageRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;

final readonly class ChatService implements ChatServiceInterface
{
    use DispatchesJobs;

    public function __construct(public ChatRepository $chats, public MemberRepository $members, private MessageRepository $messages)
    {
    }

    public function publish(Gamer $gamer, Chat $chat, string $content): void
    {
        $this->chats->executeTransaction(function () use ($chat, $gamer, $content) {
            $messageData = [
                'chat_id' => $chat->id,
                'gamer_id' => $gamer->id,
                'type' => 'message',
                'content' => $content,
            ];

            $newMessage = $this->messages->create($messageData);

            foreach ($chat->gamers as $gamer) {
                $this->dispatch(new PublishMessageJob($gamer, $newMessage));
            }
        });
    }
}
