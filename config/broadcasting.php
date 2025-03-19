<?php

declare(strict_types=1);

return [
    'connections' => [
        'centrifugo' => [
            'driver' => 'centrifugo',
            'token_hmac_secret_key' => env('CENTRIFUGO_TOKEN_HMAC_SECRET_KEY', ''),
            'api_key' => env('CENTRIFUGO_API_KEY', ''),
            'api_url' => env('CENTRIFUGO_API_URL', 'http://localhost'),
            'api_port' => env('CENTRIFUGO_API_PORT', '9000'),
            'verify' => env('CENTRIFUGO_VERIFY', false),
            'ssl_key' => env('CENTRIFUGO_SSL_KEY'),
        ],
    ]
];
