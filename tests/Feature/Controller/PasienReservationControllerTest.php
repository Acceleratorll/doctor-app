<?php

namespace Tests\Feature\Controller;

use App\Models\Schedule;
use App\Models\ScheduleType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PasienReservationControllerTest extends TestCase
{
    // public function test_it_returns_correct_view_with_valid_input()
    // {
    //     // Assuming ScheduleType with name 'testType' exists in the database
    //     $type = 'testType';
    //     $scheduleType = ScheduleType::create([
    //         'name' => $type,
    //         'desc' => 'testDesc',
    //     ]);

    //     // Create a schedule for tomorrow with the created type
    //     $schedule = Schedule::create([
    //         'schedule_date' => Carbon::tomorrow()->toDateString(),
    //         'schedule_time' => '10:00',
    //         'schedule_time_end' => '12:00', // Sample time
    //         'schedule_type_id' => $scheduleType->id,
    //         'place_id' => 1,
    //         'qty' => 10,
    //         'employee_id' => 1
    //     ]);

    //     $response = $this->get('/create', ['type' => $type]);

    //     $response->assertStatus(302);
    //     $response->assertViewIs('web.janji_temu');
    //     $response->assertViewHas('schedules');
    //     $response->assertViewHas('type', $type);
    // }
}
