<?php

declare(strict_types=1);

namespace App\Models\Gamer;

use App\Models\Chat\Chat;
use App\Models\Chat\Member;
use App\Models\Model;
use App\Traits\Model\HasFiles;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $user_id
 * @property string $username
 * @property int $tag
 * @property string $avatar_url
 * @property string $gender
 * @property Carbon $birthday
 * @property string $timezone
 * @property array $languages
 *
 * @property Collection<Service> $services
 * @property Collection<Item> $items
 * @property Collection<Chat> $chats
 */
class Gamer extends Model
{
    use HasFiles;

    public $timestamps = true;

    protected $table = 'gamers.gamers';

    protected $fillable = [
        'user_id',
        'username',
        'tag',
        'avatar_url',
        'gender',
        'birthday',
        'timezone',
        'languages',
    ];

    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
        'pivot',
    ];

    protected $casts = [
        'languages' => 'array',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function chats(): BelongsToMany
    {
        return $this->belongsToMany(Chat::class, Member::class);
    }

    protected function fileAttributes(): array
    {
        return [
            'avatar_url',
        ];
    }
}
