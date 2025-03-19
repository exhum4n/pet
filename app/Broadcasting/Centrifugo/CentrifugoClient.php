<?php

/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

namespace App\Broadcasting\Centrifugo;

use App\Broadcasting\Centrifugo\Responses\BroadcastResponse;
use App\Broadcasting\Centrifugo\Responses\ChannelsResponse;
use App\Broadcasting\Centrifugo\Responses\DisconnectResponse;
use App\Broadcasting\Centrifugo\Responses\HistoryRemoveResponse;
use App\Broadcasting\Centrifugo\Responses\HistoryResponse;
use App\Broadcasting\Centrifugo\Responses\InfoResponse;
use App\Broadcasting\Centrifugo\Responses\PresenceResponse;
use App\Broadcasting\Centrifugo\Responses\PresenceStatsResponse;
use App\Broadcasting\Centrifugo\Responses\PublishResponse;
use App\Broadcasting\Centrifugo\Responses\Response;
use App\Broadcasting\Centrifugo\Responses\SubscribeResponse;
use App\Broadcasting\Centrifugo\Responses\UnsubscribeResponse;
use Exception;
use GuzzleHttp\Client as HttpClient;
use UnitEnum;

final readonly class CentrifugoClient implements CentrifugoClientInterface
{
    private const API_PATH = '/api';

    public function __construct(public CentrifugoConfig $config, private HttpClient $httpClient)
    {
    }

    public function publish(string $channel, array $data, ?bool $skipHistory = false): PublishResponse
    {
        return $this->send(CentrifugoMethod::publish, PublishResponse::class, [
            'channel' => $channel,
            'data' => $data,
            'skip_history' => $skipHistory,
        ]);
    }

    public function broadcast(array $channels, array $data, $skipHistory = false): BroadcastResponse
    {
        return $this->send(CentrifugoMethod::broadcast, BroadcastResponse::class, [
            'channels' => $channels,
            'data' => $data,
            'skip_history' => $skipHistory,
        ]);
    }

    public function subscribe(string $channel, string $userId): SubscribeResponse
    {
        return $this->send(CentrifugoMethod::subscribe, SubscribeResponse::class, [
            'channel' => $channel,
            'user' => $userId
        ]);
    }

    public function unsubscribe(string $channel, string $userId): UnsubscribeResponse
    {
        return $this->send(CentrifugoMethod::unsubscribe, UnsubscribeResponse::class, [
            'channel' => $channel,
            'user' => $userId,
        ]);
    }

    public function disconnect(string $userId): DisconnectResponse
    {
        return $this->send(CentrifugoMethod::disconnect, DisconnectResponse::class, [
            'user' => $userId,
        ]);
    }

    public function presence(string $channel): PresenceResponse
    {
        return $this->send(CentrifugoMethod::presence, PresenceResponse::class, [
            'channel' => $channel
        ]);
    }

    public function presenceStats(string $channel): PresenceStatsResponse
    {
        return $this->send(CentrifugoMethod::presence_stats, PresenceStatsResponse::class, [
            'channel' => $channel
        ]);
    }

    public function history(string $channel, ?int $limit = 0, ?array $since = [], ?bool $reverse = false): HistoryResponse
    {
        return $this->send(CentrifugoMethod::history, HistoryResponse::class, [
            'channel' => $channel,
            'limit' => $limit,
            'reverse' => $reverse,
            'since' => $since
        ]);
    }

    public function historyRemove(string $channel): HistoryRemoveResponse
    {
        return $this->send(CentrifugoMethod::history_remove, HistoryRemoveResponse::class, [
            'channel' => $channel,
        ]);
    }

    public function channels(string $pattern = ''): ChannelsResponse
    {
        return $this->send(CentrifugoMethod::channels, ChannelsResponse::class, [
            'pattern' => $pattern
        ]);
    }

    public function info(): array
    {
        return $this->send(CentrifugoMethod::info, InfoResponse::class);
    }

    private function send(UnitEnum $method, string $responseClass, array $params = []): mixed
    {
        if (is_subclass_of($responseClass, Response::class) === false) {
            throw new Exception('wrong_response_class');
        }

        $response = $this->httpClient->post($this->makeUrl($method), [
            'headers' => $this->getHeaders(),
            'body' => json_encode((object)$params),
        ]);

        return new $responseClass($response);
    }

    private function makeUrl(UnitEnum $method): string
    {
        return "{$this->config->api_url}:{$this->config->api_port}" . self::API_PATH . '/' . $method->name;
    }

    private function getHeaders(): array
    {
        return [
            'Content-type' => 'application/json',
            'X-API-Key' => $this->config->api_key,
        ];
    }
}
