<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * User model.
 *
 * Contains basic user fields and relation to cards.
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Mass-assignable attributes
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'role',
        'is_admin',
    ];

    // Hidden fields for arrays / JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Attribute casts
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'is_admin'          => 'boolean',
            'password'          => 'hashed',
        ];
    }

    // Relations

    /**
     * User may have many cards.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany(Card::class, 'user_id');
    }
}
