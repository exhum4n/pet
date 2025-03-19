<?php

declare(strict_types=1);

namespace App\Models\Chat;

use App\Models\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $chat_id
 * @property string $gamer_id
 * @property string $role
 */
class Member extends Model
{
    use HasUuids;
    use HasFactory;

    public $timestamps = false;

    protected $table = 'chats.members';

    protected $fillable = [
        'chat_id',
        'gamer_id',
        'role',
    ];
}
