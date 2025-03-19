<?php

declare(strict_types=1);

namespace App\Services\Chat;

use App\Broadcasting\Centrifugo\CentrifugoClientInterface;

final readonly class TokenService implements TokenServiceInterface
{
    public function __construct(private CentrifugoClientInterface $client)
    {
    }

    public function getToken(string $gamerId): string
    {
        return $this->generateConnectionToken($gamerId);
    }

    private function generateConnectionToken(string $gamerId): string
    {
        $payload = [
            'sub' => $gamerId,
            'channels' => [
                "personal:$gamerId"
            ]
        ];

        return $this->makeToken($payload);
    }

    private function makeToken(array $payload): string
    {
        $segments = [];

        $segments[] = $this->urlSafeB64Encode(json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]));

        $segments[] = $this->urlSafeB64Encode(json_encode($payload));
        $signature = $this->sign(implode('.', $segments), $this->client->config->token_hmac_secret_key);
        $segments[] = $this->urlSafeB64Encode($signature);

        return implode('.', $segments);
    }

    private function urlSafeB64Encode(string $input): string
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    private function sign(string $msg, string $key): string
    {
        return hash_hmac('sha256', $msg, $key, true);
    }
}
