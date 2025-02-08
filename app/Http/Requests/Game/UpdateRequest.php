<?php

declare(strict_types=1);

namespace App\Http\Requests\Game;

use App\Models\Game\Game;

/**
 * @property string $name
 */
class UpdateRequest extends GameRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'name' => [
                'unique:' . Game::class,
                'string'
            ]
        ]);
    }
}
