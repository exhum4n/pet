<?php

declare(strict_types=1);

namespace App\Repositories\Trade;

use App\DataObjects\DataObject;
use App\DataObjects\Trade\OfferFilter;
use App\Models\Gamer\Gamer;
use App\Models\Trade\Offer;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Collection;

/**
 * @method Offer update(Offer $model, array|DataObject $data)
 */
class OfferRepository extends EloquentRepository
{
    public function getByGamer(Gamer $gamer, ?OfferFilter $filter = null): Collection
    {
        $query = $this->getQuery();

        if ($filter?->status !== null) {
            $query->where(['status' => $filter->status]);
        }

        $buyerQuery = $query->clone();
        $buyerQuery->where(['buyer_id' => $gamer->id]);

        $sellerQuery = $query->clone();
        $sellerQuery->where(['seller_id' => $gamer->id]);

        return $query->get();
    }

    protected function getModel(): string
    {
        return Offer::class;
    }
}
