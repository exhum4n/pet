<?php

declare(strict_types=1);

namespace App\Services\Chat;

use App\DataObjects\Chat\MessageDto;
use App\Enums\Chat\MessageType;
use App\Jobs\Chat\PublishMessageJob;
use App\Jobs\Chat\UploadFileJob;
use App\Models\Gamer\Gamer;
use App\Repositories\Chat\ChatRepository;
use App\Repositories\Chat\MessageRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;
use App\Models\Chat\Message;
use App\Models\Chat\Chat;

final readonly class MessageService implements MessageServiceInterface
{
    use DispatchesJobs;

    public function __construct(private ChatRepository $chats, private MessageRepository $messages)
    {
    }

    public function publish(Gamer $gamer, Chat $chat, MessageDto $messageDto): Message
    {
        return $this->chats->executeTransaction(function () use ($chat, $gamer, $messageDto) {
            $messageData = [
                'chat_id' => $chat->id,
                'gamer_id' => $gamer->id,
                'type' => MessageType::message->name,
                'content' => $messageDto->message,
            ];

            $message = $this->messages->create($messageData);

            if ($messageDto->file) {
                $this->dispatch(new UploadFileJob($gamer, $message, $messageDto?->file, $messageDto?->filename));
            }

            foreach ($chat->gamers as $chatGamer) {
                $this->dispatch(new PublishMessageJob($chatGamer, $message));
            }

            return $message;
        });
    }

    public function list(Chat $chat, int $count): Collection
    {
        return $this->messages->getByChatId($chat->id, $count);
    }

    public function getFromMessage(Message $message, int $count): Collection
    {
        return $this->messages->getFromMessage($message, $count);
    }
}
