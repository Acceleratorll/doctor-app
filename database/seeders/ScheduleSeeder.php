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
                'employee_id' => 1,
                'place_id' => 2,
                'schedule_date' => $today->toDateString(),
                'schedule_time' => $now->toTimeString(),
                'schedule_time_end' => $now->addHours(3)->toTimeString(),
                'qty' => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employee_id' => 1,
                'place_id' => 2,
                'schedule_date' => $today->toDateString(),
                'schedule_time' => $now->addHours(4)->toTimeString(),
                'schedule_time_end' => $now->addHours(7)->toTimeString(),
                'qty' => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employee_id' => 1,
                'place_id' => 1,
                'qty' => 0,
                'schedule_date' => $today->addDays(1)->toDateString(),
                'schedule_time' => $now->toTimeString(),
                'schedule_time_end' => $now->toTimeString(),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        DB::table('schedules')->insert($schedules);
    }
}
