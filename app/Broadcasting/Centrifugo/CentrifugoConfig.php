<?php

declare(strict_types=1);

namespace App\Broadcasting\Centrifugo;

use App\DataObjects\DataObject;

final class CentrifugoConfig extends DataObject
{
    public string $token_hmac_secret_key;
    public string $api_key;
    public string $api_url;
    public string $api_port;
}
