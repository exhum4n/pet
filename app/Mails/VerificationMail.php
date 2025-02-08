<?php

declare(strict_types=1);

namespace App\Mails;

use Illuminate\Mail\Mailable;

class VerificationMail extends AbstractMail
{
    protected string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function build(): Mailable
    {
        return $this->view('emails.verification')
            ->with(['code' => $this->code]);
    }
}
