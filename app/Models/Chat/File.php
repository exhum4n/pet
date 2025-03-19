<?php

declare(strict_types=1);

namespace App\Models\Chat;

use Carbon\Carbon;
use App\Models\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $message_uuid
 * @property string $type
 * @property string $name
 *
 * @property Carbon $created_at
 * @property Message $message
 */
class File extends Model
{
    use HasUuids;

    protected $table = 'chats.files';

    protected $fillable = [
        'message_id',
        'type',
        'name',
    ];

    protected $hidden = [
        'message_id',
        'external_id',
        'created_at',
    ];

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
