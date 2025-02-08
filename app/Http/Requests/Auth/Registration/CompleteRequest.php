<?php

namespace App\Http\Requests\Auth\Registration;

use App\Http\Requests\FormRequest;
use App\Models\Auth\User;

/**
 * @property string $email
 * @property string $code
 * @property string $password
 */
class CompleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'numeric',
                "digits:6"
            ],
            'email' => [
                'required',
                'unique:' . User::class,
            ],
            'password' => [
                'required',
                'min:6',
                'max:50'
            ]
        ];
    }
}
