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
        $scheduleType1 = DB::table('schedule_types')->where('name', 'Umum')->first()->id;
        $scheduleType2 = DB::table('schedule_types')->where('name', 'Gigi')->first()->id;

        $schedules = [
            [
                'employee_id' => 1,
                'place_id' => 1,
                'schedule_type_id' => $scheduleType1,
                'schedule_date' => Carbon::now()->addMonth(),
                'schedule_time' => Carbon::now(),
                'schedule_time_end' => Carbon::now()->addHours(3),
                'qty' => 10,
            ],
            [
                'employee_id' => 1,
                'place_id' => 1,
                'schedule_type_id' => $scheduleType1,
                'schedule_date' => Carbon::now()->addMonths(2),
                'schedule_time' => Carbon::now(),
                'schedule_time_end' => Carbon::now()->addHours(3),
                'qty' => 10,
            ],
            [
                'employee_id' => 1,
                'place_id' => 1,
                'schedule_type_id' => $scheduleType1,
                'schedule_date' => Carbon::now()->addMonths(3),
                'schedule_time' => Carbon::now(),
                'schedule_time_end' => Carbon::now()->addHours(3),
                'qty' => 10,
            ],
            [
                'employee_id' => 2,
                'place_id' => 1,
                'schedule_type_id' => $scheduleType2,
                'schedule_date' => Carbon::now()->addMonth(),
                'schedule_time' => Carbon::now(),
                'schedule_time_end' => Carbon::now()->addHours(3),
                'qty' => 10,
            ],
            [
                'employee_id' => 2,
                'place_id' => 1,
                'schedule_type_id' => $scheduleType2,
                'schedule_date' => Carbon::now()->addMonths(2),
                'schedule_time' => Carbon::now(),
                'schedule_time_end' => Carbon::now()->addHours(3),
                'qty' => 10,
            ],
            [
                'employee_id' => 2,
                'place_id' => 1,
                'schedule_type_id' => $scheduleType2,
                'schedule_date' => Carbon::now()->addMonths(3),
                'schedule_time' => Carbon::now(),
                'schedule_time_end' => Carbon::now()->addHours(3),
                'qty' => 10,
            ],
            [
                'employee_id' => 2,
                'place_id' => 1,
                'schedule_type_id' => $scheduleType2,
                'schedule_date' => Carbon::now()->addMonths(12),
                'schedule_time' => Carbon::now(),
                'schedule_time_end' => Carbon::now()->addHours(3),
                'qty' => 0,
            ],
        ];

        DB::table('schedules')->insert($schedules);
    }
}
