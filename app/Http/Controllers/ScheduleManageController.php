<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Employee;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleManageController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        $schedules = Schedule::with('employee')->where('schedule_date', '>=', $today)->get();
        return view('jadwal.index', compact('schedules'));
    }

    public function create()
    {
        $doctor = Employee::where('role_id', 1)->first();
        return view('jadwal.create', compact('doctor'));
    }

    public function store(ScheduleRequest $request)
    {
        $today = Carbon::today()->toDateString();
        if ($request['schedule_date'] < $today) {
            return back();
        } else {
            $input = $request->validated();
            Schedule::create($input);
            return redirect()->route('jadwal.index');
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('jadwal.edit', compact('schedule'));
    }

    public function update(ScheduleRequest $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $today = Carbon::today()->toDateString();
        if ($request['schedule_date'] < $today) {
            return back();
        } else {
            $input = $request->validated();
            $schedule->update($input);
            return redirect()->route('jadwal.index');
        }
    }

    public function destroy($id)
    {
        Schedule::findOrFail($id)->delete();
        return back();
    }
}
