<?php

declare(strict_types=1);

namespace App\Jobs\Trade;

use App\Jobs\AbstractJob;
use App\Models\Trade\Offer;

final class OfferRejectedJob extends AbstractJob
{
    public function __construct(private readonly Offer $offer)
    {
    }

    public function handle(): void
    {
        $this->offer->refresh();
    }
}
