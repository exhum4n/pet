<?php

declare(strict_types=1);

namespace App\Http\Requests\Trade;

use App\Http\Requests\GamerRequest;
use App\Models\Gamer\Item;
use App\Repositories\Gamer\ItemRepository;

/**
 * @property string $item_id
 */
class OfferRequest extends GamerRequest
{
    public Item|null $item;

    public function rules(): array
    {
        return [
            'item_id' => [
                'required',
                'exists:' . Item::class . ',id',
            ]
        ];
    }

    protected function afterValidation(array $data): void
    {
        $this->item = app(ItemRepository::class)->getByIdOrFail($this->item_id);
    }
}
