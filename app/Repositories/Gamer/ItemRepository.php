<?php

declare(strict_types=1);

namespace App\Repositories\Gamer;

use App\DataObjects\Trade\TradeFilter;
use App\Models\Gamer\Item;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Collection;

class ItemRepository extends EloquentRepository
{
    public function getForTrade(?TradeFilter $filterData = null): Collection
    {
        $query = $this->getQuery();

        if ($filterData->server_id !== null) {
            $query->where('server_id', $filterData->server_id);
        }

        if ($filterData->category_id !== null) {
            $query->where('category_id', $filterData->category_id);
        }

        if ($filterData->name !== null && strlen($filterData->name) > 2) {
            $query->whereLike('name', '%' . $filterData->name . '%');
        }

        return $query->get();
    }

    protected function getModel(): string
    {
        return Item::class;
    }
}
