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
                'role_id' => 1,
                'name' => 'Dr. Suhardji Sp. D. R.mN',
                'address' => 'Jl. Address Palace',
                'phone' => '+628097637221',
                'qualification' => 'Kulit dan Kelamin',
                'username' => 'superadmin',
                'password' => bcrypt('12345'),
            ],
        ];
        DB::table('employees')->insert($employee);
    }
}
