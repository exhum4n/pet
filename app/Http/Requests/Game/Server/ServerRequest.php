<?php

declare(strict_types=1);

namespace App\Http\Requests\Game\Server;

use App\Models\Game\Server;
use App\Http\Requests\FormRequest;
use App\Services\Game\ServerService;

class ServerRequest extends FormRequest
{
    public Server $gameServer;

    public function rules(): array
    {
        return [
            'server' => [
                'required',
                'uuid',
            ],
        ];
    }

    protected function afterValidation(array $data): void
    {
        $this->gameServer = app(ServerService::class)->servers->getByIdOrFail($data['server']);
    }
}
