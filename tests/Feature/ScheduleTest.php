<?php

namespace Tests\Feature;

use App\Models\Place;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    use WithFaker;

    protected $user;
    protected $place;
    protected $employee;
    protected $scheduleType;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user for authentication
        $this->user = User::factory()->create();
        $this->user->assignRole('superadmin');

        // Create necessary models for the test
        $this->place = \App\Models\Place::factory()->create();
        $this->employee = \App\Models\Employee::factory()->create();
        $this->scheduleType = \App\Models\ScheduleType::factory()->create();
    }
    public function test_access_schedule_list()
    {
        $place = Place::findOrFail(2);
        $schedules = Schedule::where('place_id', 2)
            ->get();
        $response = $this->actingAs(User::find(4))->get('/jadwal-place/2', [
            'schedules' => $schedules,
            'place' => $place
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('web.list_rsud');
        $response->assertViewHas('schedules');
        $response->assertViewHas('place');
    }

    public function test_empty_data_in_schedule_list()
    {
        Schedule::where('place_id', 1)->delete();

        $response = $this->actingAs(User::find(4))->get('/jadwal-place/1');

        $response->assertStatus(200);

        $response->assertViewIs('web.list_rsud');

        $response->assertViewHas('schedules', function ($schedules) {
            return $schedules->isEmpty();
        });
    }

    public function test_test_it_creates_daily_schedules()
    {
        $this->actingAs($this->user);

        $startDate = Carbon::today();
        $duration = 3; // Duration in days

        $data = [
            'employee_id' => $this->employee->id,
            'schedule_type_id' => $this->scheduleType->id,
            'place_id' => $this->place->id,
            'schedule_date' => $startDate->toDateString(),
            'schedule_time' => '09:00:00',
            'schedule_time_end' => '17:00:00',
            'qty' => 1,
            'frequency' => 'daily',
            'duration' => $duration,
            'duration_unit' => 'day',
            'identifier' => null,
        ];

        $response = $this->post(route('admin.jadwal.store'), $data);
        $response->assertStatus(302);

        $this->assertCount($duration + 1, Schedule::all());
    }

    /** @test */
    public function test_it_creates_weekly_schedules()
    {
        $this->actingAs($this->user);

        $startDate = Carbon::today();
        $duration = 2; // Duration in weeks

        $data = [
            'employee_id' => $this->employee->id,
            'schedule_type_id' => $this->scheduleType->id,
            'place_id' => $this->place->id,
            'schedule_date' => $startDate->toDateString(),
            'schedule_time' => '09:00:00',
            'schedule_time_end' => '17:00:00',
            'qty' => 1,
            'frequency' => 'weekly',
            'duration' => $duration,
            'identifier' => null,
        ];

        $response = $this->post(route('admin.jadwal.store'), $data);

        $response->assertRedirect(route('admin.jadwal.index'));
        $this->assertCount($duration + 1, Schedule::all());
    }

    /** @test */
    public function test_it_creates_monthly_schedules()
    {
        $this->actingAs($this->user);

        $startDate = Carbon::today();
        $duration = 1; // Duration in months

        $data = [
            'employee_id' => $this->employee->id,
            'schedule_type_id' => $this->scheduleType->id,
            'place_id' => $this->place->id,
            'schedule_date' => $startDate->toDateString(),
            'schedule_time' => '09:00:00',
            'schedule_time_end' => '17:00:00',
            'qty' => 1,
            'frequency' => 'monthly',
            'duration' => $duration,
            'identifier' => null,
        ];

        $response = $this->post(route('admin.jadwal.store'), $data);

        $response->assertRedirect(route('admin.jadwal.index'));
        $this->assertCount($duration + 1, Schedule::all());
    }

    /** @test */
    public function test_it_creates_single_schedule_without_frequency()
    {
        $this->actingAs($this->user);

        $startDate = Carbon::today();

        $data = [
            'employee_id' => $this->employee->id,
            'schedule_type_id' => $this->scheduleType->id,
            'place_id' => $this->place->id,
            'schedule_date' => $startDate->toDateString(),
            'schedule_time' => '09:00:00',
            'schedule_time_end' => '17:00:00',
            'qty' => 1,
            'frequency' => -1, // No frequency
            'duration' => null,
            'identifier' => null,
        ];

        $response = $this->post(route('admin.jadwal.store'), $data);

        $response->assertRedirect(route('admin.jadwal.index'));
        $this->assertCount(1, Schedule::all());
    }
}