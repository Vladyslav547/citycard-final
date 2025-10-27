<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * City model.
 *
 * Represents a city and its relationships:
 * - transportTypes (many-to-many)
 * - ticketTypes (hasMany TicketType)
 */
class City extends Model
{
    use HasFactory;

    // Mass-assignable attributes
    protected $fillable = ['name'];

    /**
     * Transport types available in this city (many-to-many).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function transportTypes()
    {
        return $this->belongsToMany(
            TransportType::class,
            'city_transport_type',   
            'city_id',
            'transport_type_id'
        )->select('transport_types.id', 'transport_types.name');
    }

    /**
     * Ticket types defined for this city.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
    }
}
