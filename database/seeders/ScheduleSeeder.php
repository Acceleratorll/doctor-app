<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        $today = Carbon::today();
        $now = Carbon::now();

        $schedules = [
            [
                'place_id' => 2,
                'schedule_date' => $today->toDateString(),
                'schedule_time' => $now->toTimeString(),
                'schedule_time_end' => $now->addHours(3)->toTimeString(),
            ],
            [
                'place_id' => 2,
                'schedule_date' => $today->toDateString(),
                'schedule_time' => $now->addHours(4)->toTimeString(),
                'schedule_time_end' => $now->addHours(7)->toTimeString(),
            ],
            [
                'place_id' => 1,
                'schedule_date' => $today->addDays(1)->toDateString(),
                'schedule_time' => $now->toTimeString(),
                'schedule_time_end' => $now->toTimeString(),
            ],
        ];
        DB::table('schedules')->insert($schedules);
    }
}
