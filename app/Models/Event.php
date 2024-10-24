<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    
    protected $table = "events";
    // Define qué campos se pueden llenar automáticamente
    protected $fillable = [
        "name",
        "description",
        "date_start",
        "date_end",
        "location",
        "max_slots",
        "occupied_slots",
        "status"
    ];

}
