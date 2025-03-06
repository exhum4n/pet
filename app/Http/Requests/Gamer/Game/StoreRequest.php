<?php

declare(strict_types=1);

namespace App\Http\Requests\Gamer\Game;

use App\Http\Requests\GamerRequest;
use App\Models\Game\Game;
use App\Repositories\Game\GameRepository;

/**
 * @property string $game_id
 * @property bool|null $now_playing
 */
class StoreRequest extends GamerRequest
{
    public Game $game;

    public function rules(): array
    {
        return [
            'game_id' => [
                'required',
                'uuid',
            ],
            'now_playing' => [
                'bool',
            ],
        ];
    }

    protected function afterValidation(array $data): void
    {
        $this->game = app(GameRepository::class)->getByIdOrFail($this->game_id);
    }
}
