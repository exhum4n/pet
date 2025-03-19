<?php

declare(strict_types=1);

namespace App\Http\Requests\Trade;

use App\DataObjects\Trade\TradeFilter;
use App\Http\Requests\FormRequest;
use App\Models\Game\Item\Category;
use App\Models\Game\Server;

class IndexRequest extends FormRequest
{
    public TradeFilter|null $filterData = null;

    public function rules(): array
    {
        return [
            'filters' => [
                'array',
            ],
            'filters.server_id' => [
                'uuid',
                'required',
                'exists:' . Server::class . ',id',
            ],
            'filters.category_id' => [
                'string',
                'exists:' . Category::class . ',id',
            ],
            'filters.name' => [
                'string',
                'min:2',
            ],
        ];
    }

    protected function afterValidation(array $data): void
    {
        if (isset($data['filters'])) {
            $this->filterData = new TradeFilter($data['filters']);
        }
    }
}
