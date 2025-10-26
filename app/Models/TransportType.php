<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * TransportType model (e.g. bus, trolleybus).
 *
 * Represents a transport type that can be linked to many cities
 * via the pivot table 'city_transport_type'.
 */
class TransportType extends Model
{
    use HasFactory;

    // Mass-assignable attributes
    protected $fillable = ['name'];

    /**
     * TransportType belongs to many cities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_transport_type', 'transport_type_id', 'city_id')
                    ->select('cities.id', 'cities.name');
    }
}
