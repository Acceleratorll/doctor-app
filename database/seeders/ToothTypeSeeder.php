<?php

namespace Database\Seeders;

use App\Models\ToothType;
use Illuminate\Database\Seeder;

class ToothTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'permanent'],
            ['name' => 'deciduous'],
        ];
        ToothType::insert($data);
    }
}
