<?php

declare(strict_types=1);

namespace App\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

abstract class AbstractMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    abstract public function build(): Mailable;
}
