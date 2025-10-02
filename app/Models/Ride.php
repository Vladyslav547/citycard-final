<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
    'card_id',
    'city_id',
    'transport_id',
    'ticket_type_id',
    'ride_time',
];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }
}
