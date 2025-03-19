<?php

/** @noinspection PhpPropertyOnlyWrittenInspection */

declare(strict_types=1);

namespace App\Http\Controllers\Gamer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gamer\Item\DestroyRequest;
use App\Http\Requests\Gamer\Item\IndexRequest;
use App\Http\Requests\Gamer\Item\StoreRequest;
use App\Http\Requests\Gamer\Item\UpdateRequest;
use App\Http\Resources\Gamer\ItemResource;
use App\Http\Resources\Gamer\ItemsResource;
use App\Http\Resources\JsonResource;
use App\Services\Gamer\ItemServiceInterface;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as Code;

final class ItemController extends Controller
{
    public function __construct(private readonly ItemServiceInterface $service)
    {
        $this->middleware('auth:sanctum');
    }

    public function index(IndexRequest $request): JsonResource
    {
        return app(ItemsResource::class, [
            'resource' => $request->gamer->items
        ]);
    }

    public function store(StoreRequest $request): JsonResource
    {
        return app(ItemResource::class, [
            'resource' => $this->service->items->create(array_merge($request->itemData->toArray(), [
                'gamer_id' => $request->gamer->id,
            ]))
        ]);
    }

    public function update(UpdateRequest $request): JsonResource
    {
        return app(ItemResource::class, [
            'resource' => $this->service->items->update($request->item, $request->itemData)
        ]);
    }

    public function destroy(DestroyRequest $request): Response
    {
        $this->service->delete($request->item);

        return response(status: Code::HTTP_NO_CONTENT);
    }
}
