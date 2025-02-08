<?php

/** @noinspection PhpTypedPropertyMightBeUninitializedInspection */

declare(strict_types=1);

namespace App\Services\Auth;

use App\Jobs\SendEmailJob;
use App\Mails\ResetPasswordMail;
use App\Models\Auth\User;
use App\Repositories\Auth\OTPRepository;
use App\Traits\Users;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Bus\DispatchesJobs;

final readonly class PasswordService
{
    use DispatchesJobs;
    use Users;

    public function __construct(protected OTPRepository $otp, protected UserService $users)
    {
    }

    /**
     * @throws AuthenticationException
     */
    public function sendRequest(string $email): void
    {
        if ($this->otp->get($email)) {
            throw new AuthenticationException('code_already_sent');
        }

        $code = $this->otp->make($email);

        $this->dispatch((new SendEmailJob($email, new ResetPasswordMail($code)))->onQueue('email'));
    }

    /**
     * @param User $user
     *
     * @throws AuthenticationException
     */
    public function change(Authenticatable $user, string $code, $password): void
    {
        $actualCode = $this->otp->get($user->email);
        if ($actualCode === null) {
            throw new AuthenticationException();
        }

        if ($actualCode !== $code) {
            throw new AuthenticationException();
        }

        $this->otp->delete($user->email);

        $this->users->updatePassword($user, $password);
    }
}
