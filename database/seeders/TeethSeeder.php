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
            ['name' => 'Gigi Geraham Bawah Kanan Ketiga', 'fdi' => '48', 'quadrant_id' => 4, 'tooth_type_id' => 1],
            ['name' => 'Gigi Geraham Bawah Kanan Kedua', 'fdi' => '47', 'quadrant_id' => 4, 'tooth_type_id' => 1],
            ['name' => 'Gigi Geraham Bawah Kanan Pertama', 'fdi' => '46', 'quadrant_id' => 4, 'tooth_type_id' => 1],
            ['name' => 'Gigi Premolar Bawah Kanan Kedua', 'fdi' => '45', 'quadrant_id' => 4, 'tooth_type_id' => 1],
            ['name' => 'Gigi Premolar Bawah Kanan Pertama', 'fdi' => '44', 'quadrant_id' => 4, 'tooth_type_id' => 1],
            ['name' => 'Gigi Taring Bawah Kanan', 'fdi' => '43', 'quadrant_id' => 4, 'tooth_type_id' => 1],
            ['name' => 'Gigi Seri Bawah kanan', 'fdi' => '42', 'quadrant_id' => 4, 'tooth_type_id' => 1],
            ['name' => 'Gigi Seri Bawah Tengah', 'fdi' => '41', 'quadrant_id' => 4, 'tooth_type_id' => 1],
            ['name' => 'Gigi Seri Bawah Tengah', 'fdi' => '31', 'quadrant_id' => 3, 'tooth_type_id' => 1],
            ['name' => 'Gigi Seri Bawah Kiri', 'fdi' => '32', 'quadrant_id' => 3, 'tooth_type_id' => 1],
            ['name' => 'Gigi Taring Bawah Kiri', 'fdi' => '33', 'quadrant_id' => 3, 'tooth_type_id' => 1],
            ['name' => 'Gigi Premolar Bawah Kiri Pertama', 'fdi' => '34', 'quadrant_id' => 3, 'tooth_type_id' => 1],
            ['name' => 'Gigi Premolar Bawah Kiri Kedua', 'fdi' => '35', 'quadrant_id' => 3, 'tooth_type_id' => 1],
            ['name' => 'Gigi Geraham Bawah Kiri Pertama', 'fdi' => '36', 'quadrant_id' => 3, 'tooth_type_id' => 1],
            ['name' => 'Gigi Geraham Bawah Kiri Kedua', 'fdi' => '37', 'quadrant_id' => 3, 'tooth_type_id' => 1],
            ['name' => 'Gigi Geraham Bawah Kiri Ketiga', 'fdi' => '38', 'quadrant_id' => 3, 'tooth_type_id' => 1],
            ['name' => 'Gigi Geraham Atas Kanan Ketiga', 'fdi' => '18', 'quadrant_id' => 1, 'tooth_type_id' => 1],
            ['name' => 'Gigi Geraham Atas Kanan Kedua', 'fdi' => '17', 'quadrant_id' => 1, 'tooth_type_id' => 1],
            ['name' => 'Gigi Geraham Atas Kanan Pertama', 'fdi' => '16', 'quadrant_id' => 1, 'tooth_type_id' => 1],
            ['name' => 'Gigi Premolar Atas Kanan Kedua', 'fdi' => '15', 'quadrant_id' => 1, 'tooth_type_id' => 1],
            ['name' => 'Gigi Premolar Atas Kanan Pertama', 'fdi' => '14', 'quadrant_id' => 1, 'tooth_type_id' => 1],
            ['name' => 'Gigi Taring Atas Kanan', 'fdi' => '13', 'quadrant_id' => 1, 'tooth_type_id' => 1],
            ['name' => 'Gigi Seri Atas kanan', 'fdi' => '12', 'quadrant_id' => 1, 'tooth_type_id' => 1],
            ['name' => 'Gigi Seri Atas Tengah', 'fdi' => '11', 'quadrant_id' => 1, 'tooth_type_id' => 1],
            ['name' => 'Gigi Seri Atas Tengah', 'fdi' => '21', 'quadrant_id' => 2, 'tooth_type_id' => 1],
            ['name' => 'Gigi Seri Atas Kiri', 'fdi' => '22', 'quadrant_id' => 2, 'tooth_type_id' => 1],
            ['name' => 'Gigi Taring Atas Kiri', 'fdi' => '23', 'quadrant_id' => 2, 'tooth_type_id' => 1],
            ['name' => 'Gigi Premolar Atas Kiri Pertama', 'fdi' => '24', 'quadrant_id' => 2, 'tooth_type_id' => 1],
            ['name' => 'Gigi Premolar Atas Kiri Kedua', 'fdi' => '25', 'quadrant_id' => 2, 'tooth_type_id' => 1],
            ['name' => 'Gigi Geraham Atas Kiri Pertama', 'fdi' => '26', 'quadrant_id' => 2, 'tooth_type_id' => 1],
            ['name' => 'Gigi Geraham Atas Kiri Kedua', 'fdi' => '27', 'quadrant_id' => 2, 'tooth_type_id' => 1],
            ['name' => 'Gigi Geraham Atas Kiri Ketiga', 'fdi' => '28', 'quadrant_id' => 2, 'tooth_type_id' => 1],
            // Gigi Susu
            ['name' => 'Gigi Seri Atas Kanan Pertama', 'fdi' => '51', 'quadrant_id' => 5, 'tooth_type_id' => 2],
            ['name' => 'Gigi Seri Atas Kanan Kedua', 'fdi' => '52', 'quadrant_id' => 5, 'tooth_type_id' => 2],
            ['name' => 'Gigi Taring Atas Kanan', 'fdi' => '53', 'quadrant_id' => 5, 'tooth_type_id' => 2],
            ['name' => 'Gigi Geraham Atas Kanan Pertama', 'fdi' => '54', 'quadrant_id' => 5, 'tooth_type_id' => 2],
            ['name' => 'Gigi Geraham Atas Kanan Kedua', 'fdi' => '55', 'quadrant_id' => 5, 'tooth_type_id' => 2],
            ['name' => 'Gigi Seri Atas Kiri Pertama', 'fdi' => '61', 'quadrant_id' => 6, 'tooth_type_id' => 2],
            ['name' => 'Gigi Seri Atas Kiri Kedua', 'fdi' => '62', 'quadrant_id' => 6, 'tooth_type_id' => 2],
            ['name' => 'Gigi Taring Atas Kiri', 'fdi' => '63', 'quadrant_id' => 6, 'tooth_type_id' => 2],
            ['name' => 'Gigi Geraham Atas Kiri Pertama', 'fdi' => '64', 'quadrant_id' => 6, 'tooth_type_id' => 2],
            ['name' => 'Gigi Geraham Atas Kiri Kedua', 'fdi' => '65', 'quadrant_id' => 6, 'tooth_type_id' => 2],
            ['name' => 'Gigi Seri Atas Kanan Pertama', 'fdi' => '81', 'quadrant_id' => 8, 'tooth_type_id' => 2],
            ['name' => 'Gigi Seri Atas Kanan Kedua', 'fdi' => '82', 'quadrant_id' => 8, 'tooth_type_id' => 2],
            ['name' => 'Gigi Taring Atas Kanan', 'fdi' => '83', 'quadrant_id' => 8, 'tooth_type_id' => 2],
            ['name' => 'Gigi Geraham Atas Kanan Pertama', 'fdi' => '84', 'quadrant_id' => 8, 'tooth_type_id' => 2],
            ['name' => 'Gigi Geraham Atas Kanan Kedua', 'fdi' => '85', 'quadrant_id' => 8, 'tooth_type_id' => 2],
            ['name' => 'Gigi Seri Atas Kiri Pertama', 'fdi' => '71', 'quadrant_id' => 7, 'tooth_type_id' => 2],
            ['name' => 'Gigi Seri Atas Kiri Kedua', 'fdi' => '72', 'quadrant_id' => 7, 'tooth_type_id' => 2],
            ['name' => 'Gigi Taring Atas Kiri', 'fdi' => '73', 'quadrant_id' => 7, 'tooth_type_id' => 2],
            ['name' => 'Gigi Geraham Atas Kiri Pertama', 'fdi' => '74', 'quadrant_id' => 7, 'tooth_type_id' => 2],
            ['name' => 'Gigi Geraham Atas Kiri Kedua', 'fdi' => '75', 'quadrant_id' => 7, 'tooth_type_id' => 2],
        ];

        DB::table('teeths')->insert($data);
    }
}
