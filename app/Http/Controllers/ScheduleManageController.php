<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ScheduleManageController extends Controller
{
    public function index()
    {
        if (!auth()->user()) {
            return redirect('login');
        }
        $today = Carbon::today()->toDateString();
        $schedules = Schedule::with('employee')->where('schedule_date', '>=', $today)->get();
        return view('jadwal.index', compact('schedules'));
    }

    public function create()
    {
        $doctor = User::where('role_id', 1)->first();
        return view('jadwal.create', compact('doctor'));
    }

    public function store(ScheduleRequest $request)
    {
        $input = $request->validated();
        Schedule::create($input);
        return redirect()->route('admin.jadwal.index');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $schedule = Schedule::with('employee')->findOrFail($id);
        return view('jadwal.edit', compact('schedule'));
    }

    public function update(ScheduleRequest $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $input = $request->validated();
        $schedule->update($input);
        return redirect()->route('admin.jadwal.index');
    }

    public function destroy($id)
    {
        Schedule::findOrFail($id)->delete();
        return back();
    }

    public function get_schedule_by_employee_id($employee_id)
    {
        $schedules = Schedule::where('employee_id', $employee_id)->get();

        return response()->json([
            'schedules' => $schedules
        ], Response::HTTP_OK);
    }
}
