<?php

declare(strict_types=1);

namespace App\Repositories\Chat;

use App\Models\Chat\File;
use App\Exceptions\EntityNotFoundException;
use App\Repositories\EloquentRepository;

/**
 * @method File create(array $data)
 */
final class FileRepository extends EloquentRepository
{
    /**
     * @throws EntityNotFoundException
     */
    public function getByExternalUuidOrFail(string $uuid): File
    {
        $record = $this->getFirst(['external_uuid' => $uuid]);
        if (is_null($record)) {
            throw new EntityNotFoundException();
        }

        return $record;
    }

    protected function getModel(): string
    {
        return File::class;
    }
}
