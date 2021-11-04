<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('divisions')->insert([
            [
                'name'                =>    'División 1',
                'created_at'          =>    date("Y-m-d H:i:s"),
                'updated_at'          =>    date("Y-m-d H:i:s")
            ],
            [
                'name'                =>    'División 2',
                'created_at'          =>    date("Y-m-d H:i:s"),
                'updated_at'          =>    date("Y-m-d H:i:s")
            ]
        ]);
    }
}
