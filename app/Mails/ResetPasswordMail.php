<?php

declare(strict_types=1);

namespace App\Mails;

use Illuminate\Mail\Mailable;

class ResetPasswordMail extends AbstractMail
{
    protected string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function build(): Mailable
    {
        return $this->view('emails.reset_password')
            ->with(['code' => $this->code]);
    }
}
