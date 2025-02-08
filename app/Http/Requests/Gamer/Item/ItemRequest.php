<?php

declare(strict_types=1);

namespace App\Http\Requests\Gamer\Item;

use App\Http\Requests\GamerRequest;
use App\Models\Gamer\Item;
use App\Services\Gamer\ItemService;

class ItemRequest extends GamerRequest
{
    public Item $item;

    public function rules(): array
    {
        return [
            'item' => [
                'required',
                'uuid',
            ]
        ];
    }

    protected function afterValidation(array $data): void
    {
        $this->item = app(ItemService::class)->items->getByIdOrFail($data['item']);
    }
}
