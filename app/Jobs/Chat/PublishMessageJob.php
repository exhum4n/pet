<?php

namespace App\Jobs\Chat;

use App\Models\Chat\Message;
use App\Broadcasting\Centrifugo\CentrifugoClientInterface;
use App\Jobs\AbstractJob;
use App\Models\Gamer\Gamer;

final class PublishMessageJob extends AbstractJob
{
    public function __construct(private readonly Gamer $gamer, private readonly Message $message)
    {
    }

    public function handle(): void
    {
        $cetrifugo = app(CentrifugoClientInterface::class);

        $data = [
            'id' => $this->message->id,
            'chat_id' => $this->message->chat_id,
            'gamer_id' => $this->message->gamer_id,
            'data' => $this->message->content,
            'type' => $this->message->type,
            'created_at' => $this->message->created_at,
        ];

        if (isset($this->message->file)) {
            $data['file'] = $this->message->file;
        }

        $cetrifugo->publish("personal:{$this->gamer->id}", $data);
    }
}
