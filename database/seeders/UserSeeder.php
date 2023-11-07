<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Dr. Suhardji Sp. D. R.mN',
                'role_id' => 1,
                'phone' => '6259106919966',
                'birth_date' => '1984-2-26',
                'email' => 'superadmin@mail.com',
                'gender' => 'Pria',
                'address' => 'Jl. Address Palace',
                'username' => 'superadmin',
                'password' => bcrypt('12345'),
            ],
            [
                'name' => 'Pegawai 1',
                'role_id' => 2,
                'phone' => '628897637221',
                'birth_date' => '1990-2-26',
                'email' => 'pegawai@mail.com',
                'gender' => 'Pria',
                'address' => 'Jl. Address Pegawai',
                'username' => 'pegawai',
                'password' => bcrypt('12345'),
            ],
            [
                'name' => 'Pasien 1',
                'role_id' => 3,
                'phone' => '628097637221',
                'birth_date' => '1984-2-26',
                'email' => 'pasien@mail.com',
                'gender' => 'Pria',
                'address' => 'Jl. Address Palace',
                'username' => 'pasien',
                'password' => bcrypt('12345'),
            ],
        ];
        DB::table('users')->insert($users);
    }
}
