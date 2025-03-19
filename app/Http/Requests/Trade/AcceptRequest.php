<?php

declare(strict_types=1);

namespace App\Http\Requests\Trade;

use App\Http\Requests\GamerRequest;
use App\Models\Trade\Offer;
use App\Repositories\Trade\OfferRepository;

/**
 * @property string $offer_id
 */
class AcceptRequest extends GamerRequest
{
    public Offer $offer;

    public function rules(): array
    {
        return [
            'offer_id' => [
                'required',
                'exists:' . Offer::class . ',id'
            ]
        ];
    }

    protected function afterValidation(array $data): void
    {
        $this->offer = app(OfferRepository::class)->getByIdOrFail($this->offer_id);
    }
}
