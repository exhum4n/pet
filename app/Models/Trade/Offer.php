<?php

declare(strict_types=1);

namespace App\Models\Trade;

use App\Models\Gamer\Gamer;
use App\Models\Gamer\Item;
use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $item_id
 * @property string $buyer_id
 * @property string $seller_id
 * @property string $status
 *
 * @property Item $item
 * @property Gamer $seller
 * @property Gamer $buyer
 */
class Offer extends Model
{
    public $timestamps = true;

    protected $table = 'trade.offers';

    protected $fillable = [
        'item_id',
        'buyer_id',
        'seller_id',
        'status',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Gamer::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Gamer::class);
    }
}
