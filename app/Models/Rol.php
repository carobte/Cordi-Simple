<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Rol extends Model
{
    protected $table = "rols"; // Specifies the associated database table.
    public $timestamps = true; // Enables automatic handling of created_at and updated_at timestamps.

    // Fields that can be mass-assigned
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Defines a one-to-many relationship with the User model.
     * A role can be assigned to multiple users.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'rols_id', 'id');
    }
}
