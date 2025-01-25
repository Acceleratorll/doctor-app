<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patient = [
            [
                'user_id' => 5,
                'height' => '144',
                'weight' => '44',
            ],
            [
                'user_id' => 6,
                'height' => '175',
                'weight' => '60',
            ],
        ];
        DB::table('patients')->insert($patient);
    }
}
