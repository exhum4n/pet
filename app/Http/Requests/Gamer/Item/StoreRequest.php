<?php

declare(strict_types=1);

namespace App\Http\Requests\Gamer\Item;

use App\DataObjects\Gamer\ItemData;
use App\Http\Requests\GamerRequest;
use App\Models\Game\Item\Category;

class StoreRequest extends GamerRequest
{
    public ItemData $itemData;

    public function rules(): array
    {
        return [
            'server_id' => [
                'required',
                'uuid',
            ],
            'name' => [
                'required',
                'string',
                'min:2',
                'max:50'
            ],
            'description' => [
                'string',
                'min:2',
                'max:255'
            ],
            'category' => [
                'required',
                'exists:' . Category::class . ',name'
            ],
            'count' => [
                'required',
                'numeric',
            ],
            'price' => [
                'required',
                'numeric',
            ]
        ];
    }

    protected function afterValidation(array $data): void
    {
        $this->itemData = new ItemData($data);
    }
}
