<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    /**
     * Obtener los equipos de la ciudad.
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
