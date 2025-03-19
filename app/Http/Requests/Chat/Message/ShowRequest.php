<?php

declare(strict_types=1);

namespace App\Http\Requests\Chat\Message;

use App\Models\Chat\Message;
use App\Repositories\Chat\MessageRepository;
use App\Http\Requests\FormRequest;

/**
 * @property string $message_id
 * @property string $count
 */
final class ShowRequest extends FormRequest
{
    public Message $message;

    public function rules(): array
    {
        return [
            'message_id' => [
                'required',
                'uuid'
            ],
            'count' => [
                'required',
                'numeric',
                'gt:0'
            ]
        ];
    }

    public function afterValidation(array $data): void
    {
        $this->message = app(MessageRepository::class)->getByIdOrFail($this->message_id);
    }
}
