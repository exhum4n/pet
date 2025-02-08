<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth\Password;

use App\Http\Requests\FormRequest;
use App\Models\Auth\User;

/**
 * @property string $email
 */
class AttemptRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email:format',
                'exists:' . User::class
            ],
        ];
    }
}
