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
                'user_id' => 3,
                'height' => '144',
                'weight' => '44',
            ],
        ];
        DB::table('patients')->insert($patient);
    }
}
