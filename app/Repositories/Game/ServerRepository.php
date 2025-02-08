<?php

declare(strict_types=1);

namespace App\Repositories\Game;

use App\Models\Game\Server;
use App\Models\Auth\User;
use App\Repositories\EloquentRepository;

/**
 * @method Server getById(int|string $id, string $pKey = 'id')
 * @method Server getByIdOrFail(int|string $id, string $pKey = 'id')
 * @method Server update(Server|User $model, array $data)
 */
class ServerRepository extends EloquentRepository
{
    protected function getModel(): string
    {
        return Server::class;
    }
}
