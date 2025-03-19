<?php

declare(strict_types=1);

namespace App\Http\Controllers\Gamer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gamer\IndexRequest;
use App\Http\Requests\Gamer\ShowRequest;
use App\Http\Requests\Gamer\StoreRequest;
use App\Http\Resources\Gamer\GamerResource;
use App\Services\Gamer\GamerServiceInterface;

final class GamerController extends Controller
{
    public function __construct(protected GamerServiceInterface $service)
    {
        $this->middleware('auth:sanctum')->only([
            'store', 'update', 'destroy'
        ]);
    }

    public function index(IndexRequest $request): GamerResource
    {
        return new GamerResource($this->service->gamers->getList($request->filterData));
    }

    public function show(ShowRequest $request): GamerResource
    {
        return new GamerResource($request->gamer);
    }

    public function store(StoreRequest $request): GamerResource
    {
        return new GamerResource($this->service->register($request->user(), $request->data));
    }
}
