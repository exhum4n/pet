<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Gamer\Gamer;
use App\Services\Gamer\GamerService;

abstract class GamerRequest extends FormRequest
{
    public Gamer $gamer;

    public function rules(): array
    {
        return [];
    }

    public function withValidator($validator): void
    {
        $this->gamer = $this->makeGamerService()->gamers->getByUser($this->user());

        parent::withValidator($validator);
    }

    private function makeGamerService(): GamerService
    {
        return app(GamerService::class);
    }
}
