<?php

namespace Tests\Feature;

use App\Models\Place;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\ScheduleType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ReservasiTest extends TestCase
{
    public function test_access_layanan_page_as_guest_redirected_to_login()
    {
        $doctor = User::with('employee')->role('superadmin')->first();
        $places = Place::all();

        $response = $this->get('/jadwal', [
            'doctor' => $doctor,
            'places' => $places
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    public function test_access_layanan_page_as_admin_unauthorized()
    {
        $doctor = User::with('employee')->role('superadmin')->first();
        $places = Place::all();

        $response = $this->actingAs(User::find(1))->get('/jadwal', [
            'doctor' => $doctor,
            'places' => $places
        ]);

        $response->assertStatus(401);
    }

    public function test_access_layanan_page_as_pasien_with_valid_data()
    {
        $doctor = User::with('employee')->role('superadmin')->first();
        $places = Place::all();

        $response = $this->actingAs(User::find(4))->get('/jadwal', [
            'doctor' => $doctor,
            'places' => $places
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('web.layanan');
        $response->assertViewHas('doctor');
        $response->assertViewHas('places');
    }

    public function test_access_layanan_page_as_pasien_without_data()
    {
        $this->actingAs(User::find(4))
            ->get('/jadwal')
            ->assertStatus(200)
            ->assertViewIs('web.layanan');
    }

    public function test_access_chooseDoctor_page_as_pasien()
    {
        $this->actingAs(User::find(4))
            ->get('/chooseDoctor')
            ->assertStatus(200)
            ->assertViewIs('web.pilih_dokter');
    }

    public function test_click_Dokter_Gigi_in_chooseDoctor_page_without_data()
    {
        $this->actingAs(User::find(4))
            ->get('/reservasi/create?type=Gigi')
            ->assertStatus(200)
            ->assertViewIs('web.janji_temu');
    }

    public function test_click_Dokter_Umum_in_chooseDoctor_page_without_data()
    {
        $response = $this->actingAs(User::find(4))
            ->get('/reservasi/create?type=Umum');

        $response->assertStatus(200);

        $response->assertViewIs('web.janji_temu');
    }

    public function test_click_Dokter_Gigi_in_chooseDoctor_page_with_valid_data()
    {
        $today = Carbon::today()->toDateString();
        $type = 'Gigi';

        $schedules = Schedule::with(['place' => function ($query) {
            $query->where('reservationable', 1);
        }, 'schedule_type'])
            ->whereHas('schedule_type', function ($q) use ($type) {
                $q->where('name', $type);
            })
            ->where('schedule_date', '>=', $today)
            ->orderBy('schedule_date', 'asc')
            ->distinct('schedule_date')
            ->get(['schedule_date', 'schedule_time_end', 'id', 'place_id', 'schedule_type_id']);

        $response = $this->actingAs(User::find(4))
            ->get('/reservasi/create?type=Gigi', [
                'schedules' => $schedules,
                'type' => $type
            ]);

        $response->assertStatus(200);

        $response->assertViewIs('web.janji_temu');
        $response->assertViewHas('schedules');
        $response->assertViewHas('type');
    }

    public function test_click_Dokter_Umum_in_chooseDoctor_page_with_valid_data()
    {
        $today = Carbon::today()->toDateString();
        $type = 'Umum';

        $schedules = Schedule::with(['place' => function ($query) {
            $query->where('reservationable', 1);
        }, 'schedule_type'])
            ->whereHas('schedule_type', function ($q) use ($type) {
                $q->where('name', $type);
            })
            ->where('schedule_date', '>=', $today)
            ->orderBy('schedule_date', 'asc')
            ->distinct('schedule_date')
            ->get(['schedule_date', 'schedule_time_end', 'id', 'place_id', 'schedule_type_id']);

        $response = $this->actingAs(User::find(4))
            ->get('/reservasi/create?type=Umum', [
                'schedules' => $schedules,
                'type' => $type
            ]);

        $response->assertStatus(200);

        $response->assertViewIs('web.janji_temu');
        $response->assertViewHas('schedules');
        $response->assertViewHas('type');
    }

    public function test_choose_date_and_time_in_choose_schedule_page_valid()
    {
        $schedule = Schedule::factory()->create();
        $response = $this->actingAs(User::find(4))->get('/confirm?schedule_date=' . $schedule->schedule_date . '&schedule_time=' . $schedule->schedule_time);

        $response->assertStatus(200);

        $response->assertViewIs('web.konfirmasi');

        $response->assertViewHas('doctor');
        $response->assertViewHas('antrian');
        $response->assertViewHas('code');
    }

    public function test_without_choosing_in_choose_schedule_page_valid()
    {
        $response = $this->actingAs(User::find(4))->get('/confirm');

        $response->assertStatus(302);
    }

    public function test_confirm_page()
    {

        $reservation = Reservation::factory()->create([
            'schedule_id' => Schedule::factory()->create([
                'schedule_type_id' => ScheduleType::where('name', 'Gigi')->first()->id,
            ]),
            'nomor_urut' => 1,
        ]);

        $nomor_urut = 1;
        $reservation_code = $reservation->reservation_code;
        $schedule_date = $reservation->schedule->schedule_date;
        $schedule_time = $reservation->schedule->schedule_time;
        $type = "Gigi";

        $response = $this->actingAs(User::find(4))->get('/bukti-pembayaran', [
            'nomor_urut' => $nomor_urut,
            'konfirmasi' => 'on',
            'reservation_code' => $reservation_code,
            'schedule_date' => $schedule_date,
            'schedule_time' => $schedule_time,
            'type' => $type
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('web.bukti_pembayaran');
    }

    public function test_successful_reservation_with_bukti_pembayaran()
    {
        $response = $this->actingAs(User::find(4))->get('/reservasi/store', [
            'schedule_date' => '2024-06-06',
            'schedule_time' => '10:00:00',
            'reservation_code' => 'ABC123',
            'nomor_urut' => 1,
            'bukti_pembayaran' => UploadedFile::fake()->image('bukti_pembayaran.jpg'),
        ]);

        $response->assertStatus(200);
    }

    public function test_successful_reservation_with_bpjs_documents()
    {
        $response = $this->actingAs(User::find(4))->get('/reservasi/store', [
            'schedule_date' => '2024-06-06',
            'schedule_time' => '10:00:00',
            'reservation_code' => 'DEF456',
            'nomor_urut' => 2,
            'ktp' => UploadedFile::fake()->image('ktp.jpg'),
            'surat_rujukan' => UploadedFile::fake()->image('surat_rujukan.jpg'),
            'bpjs_card' => UploadedFile::fake()->image('bpjs_card.jpg'),
        ]);

        $response->assertStatus(200);
    }

    // public function test_reservation_with_invalid_data()
    // {
    //     $response = $this->actingAs(User::find(4))->get('/reservasi/store');

    //     $response->assertStatus(302);
    //     $response->assertSessionHas('error', 'Data tidak valid !');
    // }

    // public function test_reservation_exceeds_quota()
    // {
    //     $schedule = Schedule::find(1);
    //     Reservation::factory()->count(11)->create(['schedule_id' => $schedule->id]);

    //     $response = $this->actingAs(User::find(4))->get('/reservasi/store', [
    //         'schedule_date' => $schedule->schedule_date,
    //         'schedule_time' => $schedule->schedule_time,
    //         'reservation_code' => 'JKL012',
    //         'nomor_urut' => 4,
    //         'bukti_pembayaran' => UploadedFile::fake()->image('bukti_pembayaran.jpg'),
    //     ]);

    //     $response->assertSessionHas('error', 'Reservasi telah mencapai batas kuota');
    // }
}
