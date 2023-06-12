<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'superadmin',
            ],
            [
                'name' => 'pegawai',
            ],
            [
                'name' => 'pasien',
            ],
        ];
        DB::table('roles')->insert($roles);
    }
}
