<?php

declare(strict_types=1);

namespace App\Models\Game;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $game_id
 * @property string $name
 */
class Service extends Model
{
    protected $table = 'games.services';

    protected $fillable = [
        'game_id',
        'name',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
