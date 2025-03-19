<?php

declare(strict_types=1);

namespace App\Repositories\Chat;

use App\Models\Chat\Chat;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Collection;

/**
 * @method Chat create(array $data)
 */
class ChatRepository extends EloquentRepository
{
    public function getByUuids(array $uuids): Collection
    {
        $query = $this->getQuery();

        $query->whereIn('id', $uuids);

        return $query->get();
    }

    protected function getModel(): string
    {
        return Chat::class;
    }
}
