<?php

declare(strict_types=1);

namespace App\Services\Trade;

use App\Models\Gamer\Gamer;
use App\Models\Gamer\Item;
use App\Models\Trade\Offer;

interface TradeServiceInterface
{
    public function create(Gamer $gamer, Item $item): Offer;

    public function accept(Offer $offer): void;

    public function reject(Offer $offer): void;
}
