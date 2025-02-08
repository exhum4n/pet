<?php

declare(strict_types=1);

namespace App\Http\Requests\Game;

use App\Models\Game\Game;
use App\Http\Requests\FormRequest;

/**
 * @property string $name
 */
class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'unique:' . Game::class,
                'string'
            ]
        ];
    }
}
