<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Team::class; 
    public function definition()
    {
        return [
            'name'=> $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'division_id' => $this->faker->numberBetween($min = 1, $max = 2),
            'city_id' =>$this->faker->numberBetween($min = 1, $max = 32),
            'number_players' => $this->faker->numberBetween($min = 15, $max = 50),

        ];
    }
}
