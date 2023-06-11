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
                'name' => 'Pasien 1',
                'phone' => '+628097637221',
                'birth_date' => '1984-2-26',
                'email' => 'superadmin@mail.com',
                'gender' => 'Pria',
                'address' => 'Jl. Address Palace',
                'username' => 'pasien',
                'password' => bcrypt('12345'),
            ],
        ];
        DB::table('patients')->insert($patient);
    }
}
