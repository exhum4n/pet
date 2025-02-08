<?php

namespace App\Http\Requests\Auth;

use App\Enums\UserStatus;
use App\Http\Requests\FormRequest;
use App\Models\Auth\User;
use App\Services\Auth\UserService;
use Illuminate\Auth\AuthenticationException;

/**
 * @property string $email
 * @property string $password
 */
class LoginRequest extends FormRequest
{
    public User $user;

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email:format',
            ],
            'password' => [
                'required',
                'string',
            ],
        ];
    }

    /**
     * @throws AuthenticationException
     */
    public function afterValidation(array $data): void
    {
        $user = app(UserService::class)->users->getByEmail($this->email);
        if ($user === null) {
            throw new AuthenticationException();
        }

        $this->user = $user;
    }
}
