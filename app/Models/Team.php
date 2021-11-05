<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'division_id',
        'city_id',
        'number_players'
    ];

    /**
     * Obtener la division del equipo.
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Obtener la ciudad del equipo.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }


    /**
     * Obtener los jugadores del equipo.
     */
    public function players()
    {
        return $this->hasMany(Player::class);
    }

    /**
     * Obtener la clasificacion del equipo.
     */
    public function classification()
    {
        return $this->hasOne(Classification::class);
    }
}
