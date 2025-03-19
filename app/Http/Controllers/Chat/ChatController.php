<?php

namespace App\Http\Controllers\Chat;

use App\Http\Requests\Chat\IndexRequest;
use App\Http\Requests\Chat\ShowRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Chat\ChatsResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

final class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(IndexRequest $request): ChatsResource
    {
        return app(ChatsResource::class, [
            'resource' => $request->gamer->chats,
        ]);
    }

    public function show(ShowRequest $request): ChatResource
    {
        Gate::authorize('show', $request->chat);

        return app(ChatResource::class, [
            'resource' => $request->chat
        ]);
    }
}
