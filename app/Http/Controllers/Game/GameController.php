<?php

declare(strict_types=1);

namespace App\Http\Controllers\Game;

use App\Http\Requests\Game\DestroyRequest;
use App\Http\Requests\Game\GameRequest;
use App\Http\Requests\Game\StoreRequest;
use App\Http\Requests\Game\UpdateRequest;
use App\Http\Resources\Game\GameResource;
use App\Models\Game\Game;
use App\Services\Game\GameService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as Code;

final class GameController extends Controller
{
    public function __construct(protected GameService $service)
    {
        $this->middleware('auth:sanctum')->only([
            'store', 'update', 'destroy'
        ]);
    }

    public function index(): JsonResource
    {
        Gate::authorize('index', Game::class);

        return app(GameResource::class, [
            'resource' => $this->service->games->getAll()
        ]);
    }

    public function show(GameRequest $request): JsonResource
    {
        Gate::authorize('show', $request->game);

        return app(GameResource::class, [
            'resource' => $request->game
        ]);
    }

    public function store(StoreRequest $request): JsonResource
    {
        Gate::authorize('store', Game::class);

        return app(GameResource::class, [
            'resource' => $this->service->games->create($request->validated())
        ]);
    }

    public function update(UpdateRequest $request): JsonResource
    {
        Gate::authorize('update', $request->game);

        return app(GameResource::class, [
            'resource' => $this->service->games->update($request->game, $request->validated())
        ]);
    }

    public function destroy(DestroyRequest $request): Response
    {
        Gate::authorize('destroy', $request->game);

        $this->service->games->deleteByModel($request->game);

        return response(status: Code::HTTP_NO_CONTENT);
    }
}
