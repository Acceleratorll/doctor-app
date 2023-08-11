<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = [
            [
                'place_id' => 2,
                'schedule_date' => '2023-08-10',
                'schedule_time' => '03:06:00',
                'schedule_time_end' => '10:07:00',
            ],
            [
                'place_id' => 2,
                'schedule_date' => '2023-08-10',
                'schedule_time' => '11:06:00',
                'schedule_time_end' => '20:07:00',
            ],
            [
                'place_id' => 1,
                'schedule_date' => '2023-09-10',
                'schedule_time' => '03:06:00',
                'schedule_time_end' => '23:07:00',
            ],
        ];
        DB::table('schedules')->insert($schedules);
    }
}
