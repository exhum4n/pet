<?php

declare(strict_types=1);

namespace App\Models\Gamer;

use App\Models\Game\Item\Category;
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
 * @property string $category_id
 * @property string $category_name
 * @property int $count
 * @property int $price
 *
 * @property Carbon $created_at
 * @property Server $server
 * @property Category $category
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
        'category_id',
        'count',
        'price',
        'stock',
    ];

    protected $hidden = [
        'deleted_at',
        'server_id',
        'gamer_id',
        'game_id',
    ];

    public function getCategoryNameAttribute(): string
    {
        return $this->category->name;
    }

    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category' => $this->category_name,
            'count' => $this->count,
            'server' => $this->server->name,
            'game' => $this->server->game->name,
            'created_at' => $this->created_at,
        ];
    }
}
