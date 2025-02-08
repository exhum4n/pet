<?php

declare(strict_types=1);

namespace App\Models\Service;

use App\Models\Model;

/**
 * @property string $name
 * @property string $description
 * @property string $category
 */
class Service extends Model
{
    protected $table = 'services.services';

    protected $fillable = [
        'name',
        'description',
        'category',
    ];
}
