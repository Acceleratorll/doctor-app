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
                'name' => 'RS Sudimulyo',
                'address' => 'Jl. Jaksa Agung Suprapto No.2, Klojen, Kec. Klojen, Kota Malang, Jawa Timur 65112',
            ],
            [
                'name' => 'Klinik Melati Indah',
                'address' => 'Jl. Jaksa Agung Suprapto No.23, Samaan, Kec. Klojen, Kota Malang, Jawa Timur 65112',
            ],
        ];
        DB::table('places')->insert($places);
    }
}
