<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $table = "reservations"; // Specifies the associated database table.
    public $timestamps = true;  // Enables automatic handling of created_at and updated_at timestamps.

    // Fields that can be mass-assigned

    protected $fillable = [
        'status',
        'user_id',
        'event_id'
    ];

    /**
     * Defines a many-to-one relationship with the User model.
     * Each reservation belongs to a specific user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Defines a many-to-one relationship with the Event model.
     * Each reservation is linked to a specific event.
     */

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
