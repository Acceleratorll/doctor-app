<?php

namespace Database\Seeders;

use App\Models\Quadrant;
use Illuminate\Database\Seeder;

class QuadrantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Gigi Permanen Rahang Atas Kanan'],
            ['name' => 'Gigi Permanen Rahang Atas Kiri'],
            ['name' => 'Gigi Permanen Rahang Bawah Kiri'],
            ['name' => 'Gigi Permanen Rahang Bawah Kanan'],
            ['name' => 'Gigi Susu Rahang Atas Kanan'],
            ['name' => 'Gigi Susu Rahang Atas Kiri'],
            ['name' => 'Gigi Susu Rahang Bawah Kiri'],
            ['name' => 'Gigi Susu Rahang Bawah Kanan'],
        ];
        Quadrant::insert($data);
    }
}
