<?php

declare(strict_types=1);

namespace App\Services\Trade;

use App\Repositories\Trade\OfferRepository;

final readonly class OfferService implements OfferServiceInterface
{
    public function __construct(public OfferRepository $offers)
    {
    }
}
