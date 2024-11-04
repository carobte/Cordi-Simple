<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{

    protected $table = "events"; // Specifies the associated database table.
    public $timestamps = true; // Enables automatic handling of created_at and updated_at timestamps.

    // Fields that can be mass-assigned

    protected $fillable = [
        'name',
        'description',
        'date_start',
        'date_end',
        'location',
        'max_slots',
        'occupied_slots',
        'status'
    ];

    /**
     * Defines a one-to-many relationship with the Reservation model.
     * An event can have multiple reservations associated with it.
     */

    public function reservation(): HasMany
    {
        return $this->hasMany(Reservation::class, 'event_id', 'id');
    }
}
