<?php

declare(strict_types=1);

namespace App\Models\Trade;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $offer_id
 * @property string $status
 * @property int $count
 * @property float $price
 * @property float $total_price
 *
 * @property Offer $offer
 */
class Deal extends Model
{
    protected $table = 'trade.deals';

    protected $fillable = [
        'offer_id',
        'status',
        'count',
        'price',
        'total_price',
    ];

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }
}
