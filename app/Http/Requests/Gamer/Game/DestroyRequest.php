<?php

declare(strict_types=1);

namespace App\Http\Requests\Gamer\Game;

use App\Http\Requests\GamerRequest;
use App\Models\Gamer\Game;
use App\Repositories\Gamer\GameRepository;

class DestroyRequest extends GamerRequest
{
    public Game $game;

    public function rules(): array
    {
        return [
            'game' => [
                'required',
                'uuid',
            ]
        ];
    }

    protected function afterValidation(array $data): void
    {
        $this->game = app(GameRepository::class)->getByIdOrFail($data['game']);
    }
}
