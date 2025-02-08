<?php

/** @noinspection PhpUndefinedClassInspection */

declare(strict_types=1);

namespace App\Traits\Model;

use Illuminate\Support\Facades\Storage;

trait HasFiles
{
    abstract protected function fileAttributes(): array;

    public function __get($key)
    {
        $attributes = $this->fileAttributes();

        if (in_array($key, $attributes)) {
            return Storage::url(parent::__get($key));
        }

        return parent::__get($key);
    }
}
