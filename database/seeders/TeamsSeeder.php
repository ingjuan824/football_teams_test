<?php

namespace Database\Seeders;

use App\Models\Classification;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $team = Team::factory()->create();
            /// Registramos  a el equipo en la tabla de posiciones 
            ///y automaticamente le asignamos la ultima posicion
            $end_position = Classification::latest('id')->first();
            Classification::create([
                'team_id' =>  $team->id,
                'position' =>  $end_position ?  $end_position->id + 1 : 1
            ]);
        }
    }
}
