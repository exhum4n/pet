<?php

namespace App\Http\Requests\Chat\Message;

use App\DataObjects\Chat\MessageDto;
use App\Http\Requests\GamerRequest;
use App\Models\Chat\Chat;
use App\Repositories\Chat\ChatRepository;

/**
 * @property string $chat_id
 * @property string $message
 */
final class StoreRequest extends GamerRequest
{
    public Chat $chat;
    public MessageDto $messageDto;

    public function rules(): array
    {
        return [
            'chat_id' => [
                'required',
                'uuid',
            ],
            'message' => [
                'required',
                'string',
            ],
        ];
    }

    public function afterValidation(array $data): void
    {
        $this->chat = app(ChatRepository::class)->getByIdOrFail($this->chat_id);

        $this->messageDto = new MessageDto($data);
    }
}
