<?php

namespace App\Http\Requests\Chat;

use App\Models\Chat\Chat;
use App\Repositories\Chat\ChatRepository;
use App\Http\Requests\FormRequest;

/**
 * @property string $chat_id
 */
final class ShowRequest extends FormRequest
{
    public Chat $chat;

    public function rules(): array
    {
        return [
            'chat_id' => [
                'required',
                'uuid',
            ],
        ];
    }

    public function afterValidation(array $data): void
    {
        $this->chat = app(ChatRepository::class)->getByIdOrFail($this->chat_id);
    }
}
