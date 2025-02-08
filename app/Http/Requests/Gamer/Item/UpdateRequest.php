<?php

declare(strict_types=1);

namespace App\Http\Requests\Gamer\Item;

use App\DataObjects\Gamer\ItemData;

class UpdateRequest extends ItemRequest
{
    public ItemData $itemData;

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'min:2',
                'max:50'
            ],
            'description' => [
                'string',
                'min:2',
                'max:255'
            ],
            'count' => [
                'numeric',
            ],
            'price' => [
                'numeric',
            ]
        ];
    }

    protected function afterValidation(array $data): void
    {
        parent::afterValidation($data);

        $this->itemData = new ItemData($data);
    }
}
