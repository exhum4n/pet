<?php

declare(strict_types=1);

namespace App\Models\Gamer;

use App\Models\Game\Server;
use App\Models\Model;
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
 * @property $created_at
 */
class Item extends Model
{
    use HasUuids;
    use SoftDeletes;

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

    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }
}
