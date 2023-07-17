<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Models\Place;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalController extends Controller
{

    public function index()
    {
        $today = Carbon::today()->timezone('Asia/Jakarta')->toDateString();
        $places = Place::all();

        $schedules = [];

        foreach ($places as $place) {
            $schedules[$place->id] = Schedule::with('place')
                ->where('place_id', $place->id)
                ->where('schedule_date', '>=', $today)
                ->get();
        }

        return response()->json(['schedules', 'places']);
    }

    public function create()
    {
        $doctor = User::where('role_id', 1)->first();
        $places = Place::all();
        return response()->json(['doctor', 'places']);
    }

    public function store(ScheduleRequest $request)
    {
        $input = $request->validated();
        $schedule = Schedule::create($input);
        return response()->json(['msg' => 'data berhasil dibuat', 'schedule' => $schedule]);
    }

    public function show($id)
    {
        $schedule = Schedule::finOrFail($id);
        return response()->json(['schedule']);
    }

    public function edit($id)
    {
        $schedule = Schedule::with('place')->findOrFail($id);
        $places = Place::all();
        return view('jadwal.edit', compact(['schedule', 'places']));
    }

    public function update(ScheduleRequest $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $input = $request->validated();
        $schedule->update($input);
        return response()->json(['msg'=>'data berhasil diubah', 'schedule'=>$schedule]);
    }

    public function destroy($id)
    {
        Schedule::findOrFail($id)->delete();
        return response()->json(['msg'=>'data berhasil dihapus']);
    }

    public function get_schedule_by_employee_id($employee_id)
    {
        $schedules = Schedule::where('employee_id', $employee_id)->get();

        return response()->json([
            'schedules' => $schedules
        ]);
    }
}
