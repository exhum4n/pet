<?php

declare(strict_types=1);

namespace App\Http\Controllers\Trade;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trade\AcceptRequest;
use App\Http\Requests\Trade\IndexRequest;
use App\Http\Requests\Trade\OfferRequest;
use App\Http\Resources\JsonResource;
use App\Http\Resources\Trade\ItemsResource;
use App\Http\Resources\Trade\OfferResource;
use App\Services\Trade\TradeServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

final class TradeController extends Controller
{
    public function __construct(private readonly TradeServiceInterface $service)
    {
        $this->middleware('auth:sanctum')->only([
            'offer', 'accept'
        ]);
    }

    public function index(IndexRequest $request): JsonResource
    {
        return app(ItemsResource::class, [
            'resource' => $this->service->items->getForTrade($request->filterData)
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function offer(OfferRequest $request): JsonResource
    {
        $this->authorize('offer', $request->item);

        return app(OfferResource::class, [
            'resource' => $this->service->create($request->gamer, $request->item)
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function accept(AcceptRequest $request): Response
    {
        $this->authorize('accept', $request->offer);

        $this->service->accept($request->offer);

        return response()->noContent();
    }

    /**
     * @throws AuthorizationException
     */
    public function reject(AcceptRequest $request): Response
    {
        $this->authorize('reject', $request->offer);

        $this->service->reject($request->offer);

        return response()->noContent();
    }
}
