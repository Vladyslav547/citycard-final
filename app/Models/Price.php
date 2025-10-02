<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'transport_id',
        'ticket_type_id',
        'price'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }
}
