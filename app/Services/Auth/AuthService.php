<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Enums\UserStatus;
use App\Models\Auth\User;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

final readonly class AuthService implements AuthServiceInterface
{
    public function __construct(protected AuthRepository $repository)
    {
    }

    /**
     * @throws AuthenticationException
     */
    public function byPassword(User $user, string $password): User
    {
        $failAttempts = $this->repository->getFailsCount($user->email);
        if ($this->isAttemptsCountReached($failAttempts)) {
            throw new AuthenticationException();
        }

        if ($user->status === UserStatus::blocked->name) {
            throw new AuthenticationException();
        }

        if ($this->isPasswordCorrect($password, $user->password)) {
            return $user;
        }

        $this->handleFail($user->email, $failAttempts);
    }

    /**
     * @throws AuthenticationException
     */
    private function handleFail(string $email, int $failAttempts): void
    {
        $failAttempts++;

        $this->repository->setFailAttempts($email, $failAttempts);

        throw new AuthenticationException();
    }

    protected function isAttemptsCountReached(int|null $failAttempts): bool
    {
        return $failAttempts >= config('auth.fail_attempts');
    }

    protected function isPasswordCorrect(string $password, string $hash): bool
    {
        return Hash::check($password, $hash);
    }
}
