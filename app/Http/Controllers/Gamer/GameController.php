<?php

declare(strict_types=1);

namespace App\Http\Controllers\Gamer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gamer\Game\DestroyRequest;
use App\Http\Requests\Gamer\Game\IndexRequest;
use App\Http\Requests\Gamer\Game\StoreRequest;
use App\Http\Resources\Game\GamesResource;
use App\Http\Resources\Gamer\GameResource;
use App\Http\Resources\JsonResource;
use App\Services\Gamer\GameService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as Code;

class GameController extends Controller
{
    public function __construct(protected GameService $service)
    {
        $this->middleware('auth:sanctum')->only([
            'index', 'store', 'destroy'
        ]);
    }

    public function index(IndexRequest $request): JsonResource
    {
        return app(GamesResource::class, [
            'resource' => $this->service->games->getByGamer($request->gamer)
        ]);
    }

    public function store(StoreRequest $request): GameResource
    {
        return app(GameResource::class, [
            'resource' => $this->service->create($request->gamer, $request->game, $request->now_playing)
        ]);
    }

    public function destroy(DestroyRequest $request): Response
    {
        Gate::authorize('destroy', $request->game);

        $this->service->games->deleteByModel($request->game);

        return response(status: Code::HTTP_NO_CONTENT);
    }
}
