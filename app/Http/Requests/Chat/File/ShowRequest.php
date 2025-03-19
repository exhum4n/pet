<?php

declare(strict_types=1);

namespace App\Http\Requests\Chat\File;

use App\Http\Requests\GamerRequest;
use App\Models\Chat\File;
use App\Repositories\Chat\FileRepository;

/**
 * @property string $file_id
 */
class ShowRequest extends GamerRequest
{
    public File $file;

    public function rules(): array
    {
        return [
            'file_id' => [
                'required',
                'uuid',
            ]
        ];
    }

    public function afterValidation(array $data): void
    {
        $this->file = app(FileRepository::class)->getById($this->file_id);
    }
}
