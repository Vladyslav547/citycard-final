<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * CardRide model - records of rides (spendings).
 *
 * Casted boarded_at to datetime for easy formatting.
 */
class CardRide extends Model
{
    use HasFactory;

    // Mass-assignable attributes
    protected $fillable = [
        'card_id',
        'city_id',
        'ticket_type_id',
        'transport_type_id',
        'price',
        'boarded_at',
    ];

    // Cast boarded_at to Carbon instance
    protected $casts = [
        'boarded_at' => 'datetime',
    ];

    // Relations

    /**
     * Card that made the ride.
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * City where the ride took place.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * TicketType used for the ride.
     */
    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    /**
     * TransportType used for the ride.
     */
    public function transportType()
    {
        return $this->belongsTo(TransportType::class);
    }
}
