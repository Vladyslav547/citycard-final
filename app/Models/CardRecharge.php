<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * CardRecharge model - records of card top-ups.
 */
class CardRecharge extends Model
{
    use HasFactory;

    // Mass-assignable attributes
    protected $fillable = [
        'card_id',
        'amount',
        'description',
    ];

    // Casts
    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Relation to card.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
