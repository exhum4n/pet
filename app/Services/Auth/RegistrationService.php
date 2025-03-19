<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Jobs\SendEmailJob;
use App\Mails\VerificationMail;
use App\Models\Auth\User;
use App\Repositories\Auth\OTPRepository;
use App\Repositories\Auth\UserRepository;
use App\Traits\Users;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Hash;

class RegistrationService implements RegistrationServiceInterface
{
    use Users;
    use DispatchesJobs;

    public function __construct(protected OTPRepository $otp, protected UserRepository $users)
    {
    }

    /**
     * @throws AuthenticationException
     */
    public function attempt(string $email): void
    {
        if ($this->otp->get($email)) {
            throw new AuthenticationException('code_already_sent');
        }

        $mail = new VerificationMail($this->otp->make($email));

        $this->dispatch((new SendEmailJob($email, $mail))->onQueue('email'));
    }

    /**
     * @throws AuthenticationException
     */
    public function complete(string $email, string $password, string $code): User
    {
        $actualCode = $this->otp->get($email);
        if ($actualCode === null) {
            throw new AuthenticationException();
        }

        if ($actualCode !== $code) {
            throw new AuthenticationException();
        }

        $this->otp->delete($email);

        return $this->users->create([
            'email'  => $email,
            'password'  => Hash::make($password),
            'role' => UserRole::gamer->name,
            'status' => UserStatus::active->name,
        ]);
    }
}
