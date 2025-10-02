<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Тип транспорту належить багатьом містам
    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_transport_type', 'transport_type_id', 'city_id')
                    ->select('cities.id', 'cities.name');
    }

    // Тип транспорту має багато конкретних транспортів
    public function transports()
    {
        return $this->hasMany(Transport::class);
    }
}
