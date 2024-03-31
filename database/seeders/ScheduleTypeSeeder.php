<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleTypeSeeder extends Seeder
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
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Umum',
                'desc' => 'Spesialis general problem'
            ],
            [
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => 'Gigi',
                'desc' => 'Spesialis gigi'
            ],
        ];

        DB::table('schedule_types')->insert($data);
    }
}
