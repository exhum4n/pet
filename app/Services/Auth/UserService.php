<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Enums\UserStatus;
use App\Models\Auth\User;
use App\Repositories\Auth\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final readonly class UserService
{
    public function __construct(public UserRepository $users)
    {
    }

    public function create(string $email, ?string $password = null): User
    {
        return $this->users->create([
            'email' => $email,
            'password' => $this->makePasswordHash($password),
            'status' => UserStatus::active->name,
        ]);
    }

    public function updatePassword(User $user, string $newPassword): User
    {
        $user->update([
            'password' => $this->makePasswordHash($newPassword)
        ]);

        return $user->refresh();
    }

    protected function makePasswordHash(?string $password = null): string
    {
        return Hash::make($password ?? Str::password(8));
    }

    protected function repository(): string
    {
        return UserRepository::class;
    }
}
