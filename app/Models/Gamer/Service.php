<?php

declare(strict_types=1);

namespace App\Models\Gamer;

use App\Models\Game\Game;
use App\Models\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $service_id
 * @property string $gamer_id
 * @property float $price
 * @property boolean $is_active
 *
 * @property Gamer $gamer
 */
class Service extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $table = 'gamers.services';

    public $timestamps = true;

    protected $fillable = [
        'service_id',
        'gamer_id',
        'price',
        'is_active',
    ];

    public function gamer(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
