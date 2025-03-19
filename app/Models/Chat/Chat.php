<?php

declare(strict_types=1);

namespace App\Models\Chat;

use App\Models\Gamer\Gamer;
use Carbon\Carbon;
use App\Models\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property string $type
 * @property string $status
 * @property string $name
 * @property string $subject_id
 *
 * @property Carbon $created_at
 * @property Collection<Member> $gamers
 */
class Chat extends Model
{
    use HasUuids;
    use HasFactory;

    public $timestamps = false;

    protected $table = 'chats.chats';

    protected $perPage = 10;

    protected $fillable = [
        'type',
        'status',
        'name',
        'subject_id',
    ];

    protected $hidden = [
        'pivot'
    ];

    public function gamers(): BelongsToMany
    {
        return $this->belongsToMany(Gamer::class, Member::class);
    }
}
