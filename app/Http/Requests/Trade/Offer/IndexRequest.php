<?php

declare(strict_types=1);

namespace App\Http\Requests\Trade\Offer;

use App\DataObjects\Trade\OfferFilter;
use App\Enums\Trade\OfferStatus;
use App\Http\Requests\GamerRequest;

class IndexRequest extends GamerRequest
{
    public OfferFilter|null $offerFilter = null;

    public function rules(): array
    {
        return [
            'filters' => [
                'array'
            ],
            'filters.status' => [
                'enum:' . OfferStatus::class
            ],
        ];
    }

    protected function afterValidation(array $data): void
    {
        if (empty($this->filters)) {
            return;
        }

        $this->offerFilter = new OfferFilter($data['filters']);
    }
}
