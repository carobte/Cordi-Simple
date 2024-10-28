<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Rol extends Model
{
    protected $table = "rols";
    public $timestamps = true;
    // Define qué campos se pueden llenar automáticamente
    protected $fillable = [
        'name',
        'description',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'rols_id', 'id');
    }

}
