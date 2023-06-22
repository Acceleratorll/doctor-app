<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = Carbon::today()->toDateString();
        $schedules = Schedule::where('schedule_date', '>=', $today)->orderBy('schedule_date', 'asc')->select(DB::raw('distinct(schedule_date)'))->get();
        return view('web.janji_temu', compact('schedules'));
    }

    public function getTime(Request $request)
    {
        $times = Schedule::whereDate('schedule_date', $request['date'])->get();

        $html = '<div class="row" id="schedule_time"></div>';

        foreach ($times as $time) {
            $html .= '<div class="row" id="schedule_time">
            <div class="col-md-3">
                                            <a href="#">
                                                <input class="form-check-input" type="radio" name="schedule_times" id="schedule_time{{ $schedule->id }}" value="' . $time['schedule_time'] . '">
                                                <label for="">
                                                    <div class="card active-card">
                                                        <div class="card-body">
                                                            <p class="card-title">' . $time['schedule_time'] . '</p>
                                                        </div>
                                                    </div>
                                                </label>
                                            </a>
                                        </div>
                                        </div>';
        }
        return response()->json($html);
    }

    public function confirm(Request $request)
    {
        dd($request);
        return view('');
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
