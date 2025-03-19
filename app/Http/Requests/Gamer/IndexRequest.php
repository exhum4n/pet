<?php

declare(strict_types=1);

namespace App\Http\Requests\Gamer;

use App\DataObjects\Gamer\GamerFilter;
use App\Enums\Gamer\Gender;
use App\Enums\Language;
use App\Http\Requests\FormRequest;
use App\Models\Game\Game;

/**
 * @property array $filters
 */
class IndexRequest extends FormRequest
{
    public GamerFilter|null $filterData = null;

    public function rules(): array
    {
        return [
            'filters' => [
                'array',
            ],
            'filters.gender' => [
                'enum:' . Gender::class,
            ],
            'filters.timezone' => [
                'timezone',
            ],
            'filters.language' => [
                'enum:' . Language::class,
            ],
            'filters.game' => [
                'exists:' . Game::class . ',id',
            ]
        ];
    }

    protected function afterValidation(array $data): void
    {
        if (isset($data['filters'])) {
            $this->filterData = new GamerFilter($data['filters']);
        }
    }
}
