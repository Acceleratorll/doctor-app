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
                'name' => 'RS Sudimulyo',
                'address' => 'Jl. Jaksa Agung Suprapto No.2, Klojen, Kec. Klojen, Kota Malang, Jawa Timur 65112',
                'reservationable' => '0'
            ],
            [
                'employee_id' => 1,
                'name' => 'Klinik Surya Timur',
                'address' => 'Jl. Sugeng No.23, Samaan, Kec. Klojen, Kota Malang, Jawa Timur 65112',
                'reservationable' => '1'
            ],
        ];
        DB::table('places')->insert($places);
    }
}
