<?php

namespace App\Http\Requests\Auth\Registration;

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
                'unique:' . User::class
            ],
        ];
    }
}
