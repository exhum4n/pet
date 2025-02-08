<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth\Password;

use App\Http\Requests\FormRequest;
use App\Models\Auth\User;
use App\Traits\Users;

/**
 * @property string $code
 * @property string $email
 * @property string $password
 */
class ChangeRequest extends FormRequest
{
    use Users;

    public User $user;

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
            ],
            'password' => [
                'required',
                'min:6',
                'max:50'
            ]
        ];
    }

    protected function afterValidation(array $data): void
    {
        parent::afterValidation($data);

        $this->user = $this->getUserByEmailOrFail($this->email);
    }
}
