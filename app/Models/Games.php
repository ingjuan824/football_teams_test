<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_team',
        'away_team',
        'local_goals',
        'away_goals',
        'date'
    ];

    /**
     * Instancia del equipo local.
     */
    public function local_team()
    {
        return $this->belongsTo(Team::class, 'foreign_key', 'local_team');
    }
    /**
     * Instancia del equipo visitante.
     */
    public function away_team()
    {
        return $this->belongsTo(Team::class, 'foreign_key', 'away_team');
    }

}
