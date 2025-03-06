<?php

declare(strict_types=1);

namespace App\Http\Requests\Game;
;
use App\Models\Game\Game;
use App\Http\Requests\FormRequest;
use App\Services\Game\GameService;

class GameRequest extends FormRequest
{
    public Game $game;

    public function rules(): array
    {
        return [
            'game' => [
                'required',
                'uuid',
            ],
        ];
    }

    protected function afterValidation(array $data): void
    {
        $this->game = app(GameService::class)->games->getByIdOrFail($data['game']);
    }
}
