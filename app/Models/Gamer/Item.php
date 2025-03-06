<?php

declare(strict_types=1);

namespace App\Models\Gamer;

use App\Models\Game\Server;
use App\Models\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $gamer_id
 * @property string $server_id
 * @property string $name
 * @property string $description
 * @property string $category
 * @property int $count
 * @property int $price
 *
 * @property Carbon $created_at
 * @property Server $server
 */
class Item extends Model
{
    use HasUuids;
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'gamers.items';

    protected $fillable = [
        'gamer_id',
        'server_id',
        'name',
        'description',
        'category',
        'count',
        'price',
    ];

    protected $hidden = [
        'deleted_at',
        'server_id',
        'gamer_id',
        'game_id',
    ];

    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }
}
