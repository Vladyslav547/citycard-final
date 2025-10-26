<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Card model represents a transport card that belongs to a user and a city.
 *
 * Attributes:
 * - user_id, number, city_id, balance, is_active
 */
class Card extends Model
{
    use HasFactory;

    // Mass-assignable attributes
    protected $fillable = [
        'user_id',
        'number',
        'city_id',
        'balance',
        'is_active',
    ];

    // Attribute casts
    protected $casts = [
        'balance' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relations

    /**
     * The owner user of the card.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The city this card belongs to (nullable).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Card top-up history.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recharges()
    {
        return $this->hasMany(CardRecharge::class);
    }

    /**
     * Card rides / spending history.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rides()
    {
        return $this->hasMany(CardRide::class);
    }
}
