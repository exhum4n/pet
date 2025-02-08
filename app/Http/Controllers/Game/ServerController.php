<?php

declare(strict_types=1);

namespace App\Http\Controllers\Game;

use App\Http\Requests\Game\GameRequest;
use App\Http\Requests\Game\Server\ServerRequest;
use App\Http\Requests\Game\Server\StoreRequest;
use App\Http\Resources\Game\ServerResource;
use App\Services\Game\ServerService;
use App\Exceptions\AlreadyDoneException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as Code;

class ServerController extends Controller
{
    public function __construct(private readonly ServerService $service)
    {
        $this->middleware('auth:sanctum')->only([
            'store', 'destroy'
        ]);
    }

    public function index(GameRequest $request): JsonResource
    {
        return new ServerResource($request->game->servers);
    }

    /**
     * @throws AlreadyDoneException
     */
    public function store(StoreRequest $request): ServerResource
    {
        return new ServerResource($this->service->create($request->game, $request->name));
    }

    public function destroy(ServerRequest $request): Response
    {
        $this->service->servers->deleteByModel($request->gameServer);

        return response(status: Code::HTTP_NO_CONTENT);
    }
}
