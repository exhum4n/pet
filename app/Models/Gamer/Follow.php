<?php

declare(strict_types=1);

namespace App\Models\Gamer;

use Carbon\Carbon;
use App\Models\Model;

/**
 * @property string $gamer_id
 *
 * @property Carbon $created_at
 */
class Follow extends Model
{
    protected $table = 'gamers.follows';

    protected $fillable = [
        'gamer_id',
    ];
}
