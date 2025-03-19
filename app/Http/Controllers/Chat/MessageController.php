<?php

declare(strict_types=1);

namespace App\Http\Controllers\Chat;

use App\Http\Requests\Chat\Message\IndexRequest;
use App\Http\Requests\Chat\Message\ShowRequest;
use App\Http\Requests\Chat\Message\StoreRequest;
use App\Http\Resources\Chat\MessageResource;
use App\Http\Resources\Chat\MessagesResource;
use App\Services\Chat\MessageServiceInterface;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

final class MessageController extends Controller
{
    public function __construct(private readonly MessageServiceInterface $service)
    {
        $this->middleware('auth:sanctum');
    }

    public function index(IndexRequest $request): MessagesResource
    {
        Gate::authorize('getMessages', $request->chat);

        return app(MessagesResource::class, [
            'resource' => $this->service->list($request->chat, (int) $request->count),
        ]);
    }

    public function store(StoreRequest $request): MessageResource
    {
        Gate::authorize('publishMessage', $request->chat);

        return app(MessageResource::class, [
            'resource' => $this->service->publish($request->gamer, $request->chat, $request->messageDto)
        ]);
    }

    public function show(ShowRequest $request): MessagesResource
    {
        Gate::authorize('showMessages', $request->message->chat);

        return app(MessagesResource::class, [
            'resource' => $this->service->getFromMessage($request->message, (int) $request->count),
        ]);
    }
}
