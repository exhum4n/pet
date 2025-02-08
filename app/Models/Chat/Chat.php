<?php

declare(strict_types=1);

namespace App\Models\Chat;

use App\Models\Model;
use Carbon\Carbon;

/**
 * @property string $name
 * @property string $status
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Chat extends Model
{
    protected $table = 'chats.chats';

    protected $fillable = [
        'name',
        'status',
    ];
}
