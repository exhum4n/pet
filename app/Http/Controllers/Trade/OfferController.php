<?php

declare(strict_types=1);

namespace App\Http\Controllers\Trade;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trade\Offer\IndexRequest;
use App\Http\Resources\JsonResource;
use App\Http\Resources\Trade\OffersResource;
use App\Services\Trade\OfferServiceInterface;

final class OfferController extends Controller
{
    public function __construct(private readonly OfferServiceInterface $service)
    {
        $this->middleware('auth:sanctum')->only([
            'index'
        ]);
    }

    public function index(IndexRequest $request): JsonResource
    {
        return app(OffersResource::class, [
            'resource' => $this->service->offers->getByGamer($request->gamer, $request->offerFilter),
            'gamer' => $request->gamer,
        ]);
    }
}
