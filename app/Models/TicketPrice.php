<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTypePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_type_id',
        'transport_type_id',
        'price',
    ];

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function transportType()
    {
        return $this->belongsTo(TransportType::class);
    }
}
