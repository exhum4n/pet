<?php

declare(strict_types=1);

namespace App\Models\Gamer;

use App\Models\Model;
use App\Traits\Model\HasFiles;
use Carbon\Carbon;
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
 *
 * @property Collection<Service> $services
 * @property Collection<Item> $items
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
    ];

    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    protected function fileAttributes(): array
    {
        return [
            'avatar_url',
        ];
    }
}
