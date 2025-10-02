<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    protected $fillable = ['card_id', 'amount', 'method', 'reference'];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
