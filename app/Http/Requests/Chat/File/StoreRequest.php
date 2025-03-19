<?php

declare(strict_types=1);

namespace App\Http\Requests\Chat\File;

use App\Http\Requests\FormRequest;
use App\Models\Chat\Chat;
use App\Repositories\Chat\ChatRepository;

/**
 * @property string $chat_id
 * @property string $file
 */
class StoreRequest extends FormRequest
{
    public Chat $chat;

    public function rules(): array
    {
        return [
            'chat_id' => [
                'required',
                'uuid',
            ],
            'file' => [
                'required',
                'nullable',
            ]
        ];
    }

    protected function afterValidation(array $data): void
    {
        $this->chat = app(ChatRepository::class)->getByIdOrFail($this->chat_id);
    }
}
