<?php

declare(strict_types=1);

namespace App\Http\Requests\Gamer;

use App\Models\Gamer\Gamer;
use App\Exceptions\EntityNotFoundException;
use App\Http\Requests\FormRequest;
use App\Services\Gamer\GamerService;

abstract class GamerRequest extends FormRequest
{
    public Gamer $gamer;

    public function rules(): array
    {
        return [
            'gamer' => [
                'required',
                'uuid',
            ]
        ];
    }

    /**
     * @throws EntityNotFoundException
     */
    protected function afterValidation(array $data): void
    {
        parent::afterValidation($data);

        $this->gamer = app(GamerService::class)->gamers->getByIdOrFail($data['gamer']);
    }
}
