<?php

declare(strict_types=1);

namespace App\Models\Game;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $name
 * @property string $image_url
 *
 * @property Collection<Service> $services
 * @property Collection<Server> $servers
 */
class Game extends Model
{
    use SoftDeletes;

    protected $table = 'games.games';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'image_url',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    protected $with = [
        'servers'
    ];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function servers(): HasMany
    {
        return $this->hasMany(Server::class);
    }
}
