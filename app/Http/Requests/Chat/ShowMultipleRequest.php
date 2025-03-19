<?php

namespace App\Http\Requests\Chat;

use App\Http\Requests\FormRequest;

/**
 * @property array $chats_uuids
 */
final class ShowMultipleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'chats_id' => [
                'required',
                'array',
            ],
            'chats_id.*' => [
                'required',
                'uuid',
            ],
        ];
    }
}
