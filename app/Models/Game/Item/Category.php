<?php

declare(strict_types=1);

namespace App\Models\Game\Item;

use App\Models\Model;

/**
 * @property string $name
 * @property string $game_id
 */
class Category extends Model
{
    protected $table = 'games.items_categories';

    protected $fillable = [
        'name',
        'game_id'
    ];
}
