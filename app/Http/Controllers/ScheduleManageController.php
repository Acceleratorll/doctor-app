<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Employee;
use App\Models\Place;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ScheduleManageController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->timezone('Asia/Jakarta')->toDateString();
        $places = Place::all();

        $schedules = [];

        foreach ($places as $place) {
            $schedules[$place->id] = Schedule::with('place')
            ->where('schedule_date', '>=', $today)
                ->where('place_id', $place->id)
                ->orderBy('schedule_date', 'desc')
                ->paginate(5);
        }

        return view('jadwal.index', compact(['schedules', 'places']));
    }

    public function create()
    {
        $doctor = User::where('role_id', 1)->first();
        $places = Place::all();
        return view('jadwal.create', compact(['doctor', 'places']));
    }

    public function store(ScheduleRequest $request)
    {
        $input = $request->validated();

        // Get the selected frequency from the form (e.g., 'daily' or 'weekly')
        $frequency = $request->input('frequency');

        // Get the duration and identifier values
        $duration = $request->input('duration');
        $identifier = $request->input('identifier');

        // Calculate the end date based on the frequency and duration
        $startDate = Carbon::parse($input['schedule_date']);
        if ($frequency !== -1) {
            $endDate = $this->calculateEndDate($startDate, $frequency, $duration, $identifier);

            while ($startDate <= $endDate) {
                Schedule::create([
                    'employee_id' => $input['employee_id'],
                    'place_id' => $input['place_id'],
                    'schedule_date' => $startDate,
                    'schedule_time' => $input['schedule_time'],
                    'schedule_time_end' => $input['schedule_time_end'],
                    'qty' => $input['qty'],
                ]);

                // Increment the date based on the selected frequency
                if ($frequency === 'daily') {
                    $startDate->addDay();
                } elseif ($frequency === 'weekly') {
                    $startDate->addWeek();
                } elseif ($frequency === 'monthly') {
                    $startDate->addMonth();
                }
            }
        } else {
            Schedule::create([
                'employee_id' => $input['employee_id'],
                'place_id' => $input['place_id'],
                'schedule_date' => $startDate,
                'schedule_time' => $input['schedule_time'],
                'schedule_time_end' => $input['schedule_time_end'],
                'qty' => $input['qty'],
            ]);
        }

        return redirect()->route('admin.jadwal.index');
    }

    private function calculateEndDate($startDate, $frequency, $duration, $identifier)
    {
        $endDate = $startDate->copy();
        if ($identifier === 'week') {
            $endDate->addWeeks($duration);
        } elseif ($identifier === 'day') {
            $endDate->addDays($duration);
        } elseif ($identifier === 'month') {
            $endDate->addMonths($duration);
        } elseif ($identifier === 'year') {
            $endDate->addYears($duration);
        }

        return $endDate;
    }

    public function show($id)
    {
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
        return redirect()->route('admin.jadwal.index');
    }

    public function destroy($id)
    {
        Schedule::findOrFail($id)->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal deleted successfully');
    }

    public function get_schedule_by_employee_id($employee_id)
    {
        $schedules = Schedule::where('employee_id', $employee_id)->get();

        return response()->json([
            'schedules' => $schedules
        ], Response::HTTP_OK);
    }
}
