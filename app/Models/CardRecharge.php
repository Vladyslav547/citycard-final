<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CardRecharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'amount',
        'description',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
