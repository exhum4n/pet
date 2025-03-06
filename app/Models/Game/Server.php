<?php

declare(strict_types=1);

namespace App\Models\Game;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $name
 * @property string $game_id
 *
 * @property Game $game
 */
class Server extends Model
{
    use SoftDeletes;

    protected $table = 'games.servers';

    protected $fillable = [
        'name',
        'game_id',
    ];

    protected $hidden = [
        'game_id',
        'deleted_at',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
