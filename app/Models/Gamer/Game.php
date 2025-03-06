<?php

declare(strict_types=1);

namespace App\Models\Gamer;

use App\Models\Model;

/**
 * @property string $gamer_id
 * @property string $game_id
 * @property bool $now_playing
 *
 * @property string $created_at
 */
class Game extends Model
{
    protected $table = 'gamers.games';

    protected $fillable = [
        'gamer_id',
        'game_id',
        'now_playing',
    ];
}
