<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $places = [
            [
                'employee_id' => 1,
                'name' => 'Cabang Citraland',
                'address' => 'Jl. Sentra Taman G-Walk No.22',
                'reservationable' => '1'
            ],
            [
                'employee_id' => 1,
                'name' => 'Cabang Siwalankerto',
                'address' => 'Jl. Siwalankerto VIII Blok C6',
                'reservationable' => '1'
            ],
        ];
        DB::table('places')->insert($places);
    }
}
