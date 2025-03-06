<?php

declare(strict_types=1);

namespace App\Http\Requests\Game;

use App\DataObjects\Game\FilterData;
use App\Http\Requests\FormRequest;

class IndexRequest extends FormRequest
{
    public FilterData|null $filterData = null;

    public function rules(): array
    {
        return [
            'filters' => [
                'array',
            ],
            'filters.name' => [
                'string',
            ],
        ];
    }

    protected function afterValidation(array $data): void
    {
        if (isset($data['filters']) === false) {
            return;
        }

        $this->filterData = new FilterData($data['filters']);
    }
}
