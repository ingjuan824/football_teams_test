<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['city_id' => 1, 'city_code' => 'Bog', 'city_name' => 'Bogotá',],
            ['city_id' => 2, 'city_code' => 'Med', 'city_name' => 'Medellín',],
            ['city_id' => 3, 'city_code' => 'Cal', 'city_name' => 'Cali',],
            ['city_id' => 4, 'city_code' => 'Bar', 'city_name' => 'Barranquilla',],
            ['city_id' => 5, 'city_code' => 'Car', 'city_name' => 'Cartagena',],
            ['city_id' => 6, 'city_code' => 'Cúc', 'city_name' => 'Cúcuta',],
            ['city_id' => 7, 'city_code' => 'Soa', 'city_name' => 'Soacha',],
            ['city_id' => 8, 'city_code' => 'Sol', 'city_name' => 'Soledad',],
            ['city_id' => 9, 'city_code' => 'Buc', 'city_name' => 'Bucaramanga',],
            ['city_id' => 10, 'city_code' => 'Bel', 'city_name' => 'Bello',],
            ['city_id' => 11, 'city_code' => 'Vil', 'city_name' => 'Villavicencio',],
            ['city_id' => 12, 'city_code' => 'Iba', 'city_name' => 'Ibagué',],
            ['city_id' => 13, 'city_code' => 'San', 'city_name' => 'Santa Marta',],
            ['city_id' => 14, 'city_code' => 'Val', 'city_name' => 'Valledupar',],
            ['city_id' => 15, 'city_code' => 'Mon', 'city_name' => 'Montería',],
            ['city_id' => 16, 'city_code' => 'Per', 'city_name' => 'Pereira',],
            ['city_id' => 17, 'city_code' => 'Man', 'city_name' => 'Manizales',],
            ['city_id' => 18, 'city_code' => 'Pas', 'city_name' => 'Pasto',],
            ['city_id' => 19, 'city_code' => 'Nei', 'city_name' => 'Neiva',],
            ['city_id' => 20, 'city_code' => 'Pal', 'city_name' => 'Palmira',],
            ['city_id' => 21, 'city_code' => 'Pop', 'city_name' => 'Popayán',],
            ['city_id' => 22, 'city_code' => 'Bue', 'city_name' => 'Buenaventura',],
            ['city_id' => 23, 'city_code' => 'Flo', 'city_name' => 'Floridablanca',],
            ['city_id' => 24, 'city_code' => 'Arm', 'city_name' => 'Armenia',],
            ['city_id' => 25, 'city_code' => 'Sin', 'city_name' => 'Sincelejo',],
            ['city_id' => 26, 'city_code' => 'Ita', 'city_name' => 'Itagüí',],
            ['city_id' => 27, 'city_code' => 'Tum', 'city_name' => 'Tumaco',],
            ['city_id' => 28, 'city_code' => 'Env', 'city_name' => 'Envigado',],
            ['city_id' => 29, 'city_code' => 'Dos', 'city_name' => 'Dosquebradas',],
            ['city_id' => 30, 'city_code' => 'Tul', 'city_name' => 'Tuluá',],
            ['city_id' => 31, 'city_code' => 'Bar', 'city_name' => 'Barrancabermeja',],
            ['city_id' => 32, 'city_code' => 'Rio', 'city_name' => 'Riohacha',],
        ];

        foreach ($cities as $key => $city) {
            DB::table('cities')->insert(
                [
                    'name'                =>    $city['city_name'],
                    'code'                =>    $city['city_code'],
                    'created_at'          =>    date("Y-m-d H:i:s"),
                    'updated_at'          =>    date("Y-m-d H:i:s")
                ],
            );
        }
    }
}
