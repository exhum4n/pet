<?php

declare(strict_types=1);

namespace App\Http\Requests\Game\Item\Category;

use App\Http\Requests\Game\GameRequest;

/**
 * @property string $name
 */
final class StoreRequest extends GameRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'name' => [
                'required',
            ],
        ]);
    }
}
