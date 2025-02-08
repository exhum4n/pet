<?php

declare(strict_types=1);

namespace App\Http\Requests\Game\Server;

use App\Http\Requests\FormRequest;
use App\Models\Game\Game;
use App\Services\Game\GameService;

/**
 * @property string $name
 * @property Game $game
 */
class StoreRequest extends FormRequest
{
    public Game $game;

    public function rules(): array
    {
        return [
            'game' => [
                'required',
                'uuid',
            ],
            'name' => [
                'required',
                'string',
            ],
        ];
    }

    protected function afterValidation(array $data): void
    {
        $this->game = app(GameService::class)->games->getById($data['game']);
    }
}
