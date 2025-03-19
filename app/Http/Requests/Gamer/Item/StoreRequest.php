<?php

declare(strict_types=1);

namespace App\Http\Requests\Gamer\Item;

use App\DataObjects\Gamer\ItemData;
use App\Http\Requests\GamerRequest;
use App\Models\Game\Item\Category;
use App\Models\Game\Server;

class StoreRequest extends GamerRequest
{
    public ItemData $itemData;

    public function rules(): array
    {
        return [
            'server_id' => [
                'required',
                'uuid',
                'exists:' . Server::class . ',id'
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
            'category_id' => [
                'required',
                'exists:' . Category::class . ',id'
            ],
            'count' => [
                'required',
                'numeric',
                'min:1',
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'stock' => [
                'required',
                'numeric',
                'min:1',
            ]
        ];
    }

    protected function afterValidation(array $data): void
    {
        $this->itemData = new ItemData($data);
    }
}
