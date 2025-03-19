<?php

declare(strict_types=1);

namespace App\Broadcasting\Centrifugo;

use App\Broadcasting\Centrifugo\Responses\BroadcastResponse;
use App\Broadcasting\Centrifugo\Responses\ChannelsResponse;
use App\Broadcasting\Centrifugo\Responses\DisconnectResponse;
use App\Broadcasting\Centrifugo\Responses\HistoryRemoveResponse;
use App\Broadcasting\Centrifugo\Responses\HistoryResponse;
use App\Broadcasting\Centrifugo\Responses\PresenceResponse;
use App\Broadcasting\Centrifugo\Responses\PresenceStatsResponse;
use App\Broadcasting\Centrifugo\Responses\PublishResponse;
use App\Broadcasting\Centrifugo\Responses\SubscribeResponse;
use App\Broadcasting\Centrifugo\Responses\UnsubscribeResponse;

interface CentrifugoClientInterface
{
    public function publish(string $channel, array $data, ?bool $skipHistory = false): PublishResponse;

    public function broadcast(array $channels, array $data, ?bool $skipHistory = false): BroadcastResponse;

    public function subscribe(string $channel, string $userId): SubscribeResponse;

    public function unsubscribe(string $channel, string $userId): UnsubscribeResponse;

    public function disconnect(string $userId): DisconnectResponse;

    public function presence(string $channel): PresenceResponse;

    public function presenceStats(string $channel): PresenceStatsResponse;

    public function history(string $channel, ?int $limit = 0, ?array $since = [], ?bool $reverse = false): HistoryResponse;

    public function historyRemove(string $channel): HistoryRemoveResponse;

    public function channels(string $pattern = ''): ChannelsResponse;

    public function info();
}
