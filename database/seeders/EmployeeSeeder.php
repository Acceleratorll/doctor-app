<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = [
            [
                'user_id' => 1,
                'qualification' => 'Kulit dan Kelamin',
                'icd_token' => '',
            ],
        ];
        DB::table('employees')->insert($employee);
    }
}
