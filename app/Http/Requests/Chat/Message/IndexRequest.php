<?php

namespace App\Http\Requests\Chat\Message;

use App\Http\Requests\FormRequest;
use App\Models\Chat\Chat;
use App\Repositories\Chat\ChatRepository;

/**
 * @property string $chat_uuid
 * @property string $count
 */
final class IndexRequest extends FormRequest
{
    public Chat $chat;

    public function rules(): array
    {
        return [
            'chat_id' => [
                'uuid',
                'required',
            ],
            'count' => [
                'required',
                'numeric',
                'gt:0',
            ],
        ];
    }

    public function afterValidation(array $data): void
    {
        $this->chat = app(ChatRepository::class)->getByIdOrFail($data['chat_id']);
    }
}
