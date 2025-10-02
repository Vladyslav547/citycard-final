<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardRide extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'city_id',
        'ticket_type_id',
        'transport_type_id',
        'price',
        'boarded_at',
    ];

    protected $casts = [
        'boarded_at' => 'datetime',
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function transportType()
    {
        return $this->belongsTo(TransportType::class);
    }
}
