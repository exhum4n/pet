<?php

declare(strict_types=1);

namespace App\Models\Chat;

use App\Models\Gamer\Gamer;
use Carbon\Carbon;
use App\Models\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $chat_id
 * @property string $gamer_id
 * @property string $type
 * @property string $content
 *
 * @property Carbon $created_at
 * @property Gamer $gamer
 * @property Chat $chat
 * @property File $file
 */
class Message extends Model
{
    use HasUuids;
    use HasFactory;

    public $timestamps = true;

    protected $table = 'chats.messages';

    protected $fillable = [
        'chat_id',
        'gamer_id',
        'type',
        'content',
    ];

    protected $casts = [
        'content' => 'json'
    ];

    public function gamer(): BelongsTo
    {
        return $this->belongsTo(Gamer::class);
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function file(): HasOne
    {
        return $this->hasOne(File::class);
    }
}
