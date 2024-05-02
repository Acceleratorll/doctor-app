<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Permukaan Gigi',
            ],
            [
                'name' => 'Keadaan Gigi',
            ],
            [
                'name' => 'Bahan Restorasi',
            ],
            [
                'name' => 'Restorasi',
            ],
            [
                'name' => 'Protesa',
            ],
            [
                'name' => 'Lain-lain',
            ],
        ];

        DB::table('groups')->insert($data);
    }
}
