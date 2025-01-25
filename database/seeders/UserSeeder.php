<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'dr. Sutomo Surya',
            'phone' => '6287872842868',
            'birth_date' => '1984-2-26',
            'email' => 'superadmin@mail.com',
            'gender' => 'Pria',
            'address' => 'Jl. Address Palace',
            'username' => 'superadmin',
            'password' => bcrypt('12345'),
        ])->assignRole('superadmin', 'dokter_umum');

        User::create([
            'name' => 'dr. Dentist',
            'phone' => '628897637221',
            'birth_date' => '1990-2-26',
            'email' => 'dentist@mail.com',
            'gender' => 'Pria',
            'address' => 'Jl. Address Dentist',
            'username' => 'dentist',
            'password' => bcrypt('12345'),
        ])->assignRole('dokter_gigi');
        
        User::create([
            'name' => 'dr. Dokter Umum',
            'phone' => '628897637221',
            'birth_date' => '1990-2-26',
            'email' => 'doctor@mail.com',
            'gender' => 'Pria',
            'address' => 'Jl. Address Dentist',
            'username' => 'dentist',
            'password' => bcrypt('12345'),
        ])->assignRole('dokter_umum');

        User::create([
            'name' => 'Pegawai 1',
            'phone' => '628897637221',
            'birth_date' => '1990-2-26',
            'email' => 'pegawai@mail.com',
            'gender' => 'Pria',
            'address' => 'Jl. Address Pegawai',
            'username' => 'pegawai',
            'password' => bcrypt('12345'),
        ])->assignRole('pegawai');

        User::create([
            'name' => 'Pasien 1',
            'phone' => '628097637221',
            'birth_date' => '1984-2-26',
            'email' => 'pasien@mail.com',
            'gender' => 'Pria',
            'address' => 'Jl. Address Palace',
            'username' => 'pasien',
            'password' => bcrypt('12345'),
        ])->assignRole('pasien');

        User::create([
            'name' => 'Pasien 2',
            'phone' => '628219221221',
            'birth_date' => '1999-3-31',
            'email' => 't2406748@gmail.com',
            'gender' => 'Wanita',
            'address' => 'Jl. Free Palestina',
            'username' => 'pasien 2',
            'password' => bcrypt('12345'),
        ])->assignRole('pasien');
    }
}
