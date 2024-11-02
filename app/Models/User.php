<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable; // Enables factory creation and notification capabilities.

    /**
     * The attributes that are mass assignable.
     * Fields that can be assigned in bulk when creating or updating a user.
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'rols_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Sensitive information that should not be exposed.
     */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast to specific types.
     * This defines how certain fields are formatted when retrieved.
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Defines a belongs-to relationship with the Rol model.
     * This indicates that a user is associated with a specific role.
     */

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'rols_id', 'id');
    }

    /**
     * Defines a one-to-many relationship with the Reservation model.
     * A user can have multiple reservations associated with their account.
     */

    public function reservation(): HasMany
    {
        return $this->hasMany(Reservation::class, 'user_id', 'id');
    }
}
