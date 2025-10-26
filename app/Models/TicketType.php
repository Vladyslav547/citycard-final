<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Ticket type model (e.g. Standard, Student).
 *
 * Attributes: name, price, city_id
 */
class TicketType extends Model
{
    use HasFactory;

    // Mass-assignable attributes
    protected $fillable = [
        'name',
        'price',
        'city_id',
    ];

    /**
     * Ticket type belongs to a city.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
