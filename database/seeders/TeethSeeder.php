<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeethSeeder extends Seeder
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
                'name' => 'Gigi Geraham Bawah Kanan Kedua',
                'fdi' => '47'
            ],
            [
                'name' => 'Gigi Geraham Bawah Kanan Pertama',
                'fdi' => '46'
            ],
            [
                'name' => 'Gigi Premolar Bawah Kanan Kedua',
                'fdi' => '45'
            ],
            [
                'name' => 'Gigi Premolar Bawah Kanan Pertama',
                'fdi' => '44'
            ],
            [
                'name' => 'Gigi Taring Bawah Kanan',
                'fdi' => '43'
            ],
            [
                'name' => 'Gigi Seri Bawah kanan',
                'fdi' => '42'
            ],
            [
                'name' => 'Gigi Seri Bawah Tengah',
                'fdi' => '41'
            ],
            [
                'name' => 'Gigi Seri Bawah Tengah',
                'fdi' => '31'
            ],
            [
                'name' => 'Gigi Seri Bawah Kiri',
                'fdi' => '32'
            ],
            [
                'name' => 'Gigi Taring Bawah Kiri',
                'fdi' => '33'
            ],
            [
                'name' => 'Gigi Premolar Bawah Kiri Pertama',
                'fdi' => '34'
            ],
            [
                'name' => 'Gigi Premolar Bawah Kiri Kedua',
                'fdi' => '35'
            ],
            [
                'name' => 'Gigi Geraham Bawah Kiri Pertama',
                'fdi' => '36'
            ],
            [
                'name' => 'Gigi Geraham Bawah Kiri Kedua',
                'fdi' => '37'
            ],
            [
                'name' => 'Gigi Geraham Atas Kanan Kedua',
                'fdi' => '17'
            ],
            [
                'name' => 'Gigi Geraham Atas Kanan Pertama',
                'fdi' => '16'
            ],
            [
                'name' => 'Gigi Premolar Atas Kanan Kedua',
                'fdi' => '15'
            ],
            [
                'name' => 'Gigi Premolar Atas Kanan Pertama',
                'fdi' => '14'
            ],
            [
                'name' => 'Gigi Taring Atas Kanan',
                'fdi' => '13'
            ],
            [
                'name' => 'Gigi Seri Atas kanan',
                'fdi' => '12'
            ],
            [
                'name' => 'Gigi Seri Atas Tengah',
                'fdi' => '11'
            ],
            [
                'name' => 'Gigi Seri Atas Tengah',
                'fdi' => '21'
            ],
            [
                'name' => 'Gigi Seri Atas Kiri',
                'fdi' => '22'
            ],
            [
                'name' => 'Gigi Taring Atas Kiri',
                'fdi' => '23'
            ],
            [
                'name' => 'Gigi Premolar Atas Kiri Pertama',
                'fdi' => '24'
            ],
            [
                'name' => 'Gigi Premolar Atas Kiri Kedua',
                'fdi' => '25'
            ],
            [
                'name' => 'Gigi Geraham Atas Kiri Pertama',
                'fdi' => '26'
            ],
            [
                'name' => 'Gigi Geraham Atas Kiri Kedua',
                'fdi' => '27'
            ],
        ];

        DB::table('teeths')->insert($data);
    }
}
