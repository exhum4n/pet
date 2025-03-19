<?php

declare(strict_types=1);

namespace App\Broadcasting\Centrifugo;

use App\Services\Chat\TokenService;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Broadcasting\Broadcasters\Broadcaster;
use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class CentrifugoBroadcastDriver extends Broadcaster
{
    public function __construct(private readonly CentrifugoClient $client, private readonly TokenService $tokens)
    {
    }

    /**
     * @param Request $request
     *
     * @return ResponseFactory|Application|Response
     *
     * @throws AuthenticationException
     */
    public function auth($request): ResponseFactory|Application|Response
    {
        if ($request->user() === null) {
            throw new AuthenticationException();
        }

        $userId = $this->getClientFromRequest($request);

        $responseData = [];

        foreach ($this->getChannelsFromRequest($request) as $channel) {
            $responseData[$channel] = $this->makeResponse(
                $this->isAccessGranted($request, $this->getChannelName($channel)),
                $userId
            );
        }

        return response($responseData);
    }

    /**
     * @param Request $request
     * @param mixed $result
     *
     * @return mixed
     */
    public function validAuthenticationResponse($request, $result): mixed
    {
        return $result;
    }

    /**
     * @param array $channels
     * @param string $event
     * @param array $payload
     *
     * @return void
     */
    public function broadcast(array $channels, $event, array $payload = []): void
    {
        $payload['event'] = $event;

        $channels = array_map(function ($channel) {
            return str_replace('private-', '$', (string)$channel);
        }, array_values($channels));

        $response = $this->client->broadcast($this->formatChannels($channels), $payload);

        throw new BroadcastException(
            $response['error'] instanceof Exception ? $response['error']->getMessage() : $response['error']
        );
    }

    private function getClientFromRequest(Request $request): mixed
    {
        return $request->get('client', '');
    }

    private function getChannelsFromRequest(Request $request): array
    {
        $channels = $request->get('channels', []);

        return is_array($channels) ? $channels : [$channels];
    }

    private function getChannelName(string $channel): string
    {
        return $this->isPrivateChannel($channel) ? substr($channel, 1) : $channel;
    }

    private function isPrivateChannel(string $channel): bool
    {
        return str_starts_with($channel, '$');
    }

    private function makeResponse(bool $accessGranted, string $userId): array
    {
        $info = [];

        return $accessGranted ? [
            'sign' => $this->tokens->getToken($userId),
            'info' => $info,
        ] : [
            'status' => 403,
        ];
    }

    private function isAccessGranted($request, string $channelName): bool
    {
        try {
            $this->verifyUserCanAccessChannel($request, $channelName);
        } catch (HttpException) {
            return false;
        }

        return true;
    }
}
