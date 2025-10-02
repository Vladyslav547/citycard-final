<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Види транспорту у місті
    public function transportTypes()
    {
        return $this->belongsToMany(TransportType::class, 'city_transport_type', 'city_id', 'transport_type_id')
                    ->select('transport_types.id', 'transport_types.name');
    }

    // Ціни
    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    // Типи квитків у місті
    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
    }
}
