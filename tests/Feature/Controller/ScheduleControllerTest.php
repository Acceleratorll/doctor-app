<?php

namespace Tests\Feature\Controller;

use App\Models\Place;
use App\Models\Schedule;
use App\Models\ScheduleType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleControllerTest extends TestCase
{

    public function test_index_with_all_data()
    {
        $place1 = Place::factory()->create();
        $place2 = Place::factory()->create();

        // Create schedules for today and the future using factories
        $today = Carbon::today()->timezone('Asia/Jakarta')->toDateString();
        $tomorrow = Carbon::tomorrow()->timezone('Asia/Jakarta')->toDateString();

        Schedule::factory()->create([
            'schedule_date' => $today,
            'place_id' => $place1->id
        ]);

        Schedule::factory()->create([
            'schedule_date' => $tomorrow,
            'place_id' => $place2->id
        ]);

        $response = $this->actingAs(User::find(1))->get('/admin/jadwal', [
            'schedules' => Schedule::all(),
            'places' => Place::all()
        ]);

        // Ensure the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the correct view is returned
        $response->assertViewIs('jadwal.index');

        // Assert that the view has 'schedules' and 'places' variables
        $response->assertViewHas('schedules');
        $response->assertViewHas('places');

        // Additional assertions to ensure the schedules data is correct
        $viewSchedules = $response->viewData('schedules');
        $this->assertArrayHasKey($place1->id, $viewSchedules);
        $this->assertArrayHasKey($place2->id, $viewSchedules);
        $this->assertCount(1, $viewSchedules[$place1->id]);
        $this->assertCount(1, $viewSchedules[$place2->id]);
    }

    public function test_index_without_data()
    {
        $response = $this->actingAs(User::find(1))->get('/admin/jadwal');

        $response->assertStatus(200);

        $response->assertViewIs('jadwal.index');
    }

    public function test_returns_create_view_with_data()
    {
        $doctors = User::role(['dokter_umum', 'dokter_gigi'])->get();
        $places = Place::all();
        $schedule_types = ScheduleType::all();

        $response = $this->actingAs(User::find(1))->get('/admin/jadwal/create', [
            'doctors' => $doctors,
            'places' => $places,
            'schedule_types' => $schedule_types
        ]);

        $response->assertStatus(200);
        $response->assertViewHasAll(['doctors', 'places', 'schedule_types']);
    }

    public function test_returns_edit_view_with_data()
    {
        $schedule = Schedule::factory()->create();

        $response = $this->actingAs(User::find(1))->get('/admin/jadwal/' . $schedule->id . '/edit', [
            'schedule' => $schedule,
            'doctors' => User::role(['dokter_umum', 'dokter_gigi'])->get(),
            'places' => Place::all(),
            'schedule_types' => ScheduleType::all()
        ]);

        $response->assertStatus(200);
        // $response->assertViewHas('schedule');
        // $response->assertViewHas('doctors');
        // $response->assertViewHas('places');
        // $response->assertViewHas('schedule_types');
    }
}
