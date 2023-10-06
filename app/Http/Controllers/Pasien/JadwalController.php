<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctor = User::with('employee')->where('role_id', 1)->first();
        $places = Place::all();
        return view('web.layanan', compact('doctor', 'places'));
    }

    public function schedulesByPlace($place_id)
    {
        $today = Carbon::today()->toDateString();
        $place = Place::findOrFail($place_id);
        $schedules = Schedule::where('place_id', $place_id)
            ->where('schedule_date', '>=', $today)
            ->orderBy('schedule_date', 'asc')
            ->orderBy('schedule_time', 'asc')
            ->get();

        // Group the schedules by date
        $schedules = $schedules->groupBy('schedule_date');
        return view('web.list_rsud', compact(['schedules', 'place']));
    }

    public function indexRs()
    {
        $today = Carbon::today()->toDateString();
        $place = Place::findOrFail(1);
        $schedules = Schedule::where('place_id', 1)
            ->where('schedule_date', '>=', $today)
            ->orderBy('schedule_date', 'asc')
            ->orderBy('schedule_time', 'asc')
            ->get();

        // Group the schedules by date
        $schedules = $schedules->groupBy('schedule_date');
        return view('web.list_rsud', compact(['schedules', 'place']));
    }

    public function indexKlinik()
    {
        $place = Place::findOrFail(2);
        $today = Carbon::today()->toDateString();
        $schedules = Schedule::where('place_id', 2)
            ->where('schedule_date', '>=', $today)
            ->orderBy('schedule_date', 'asc')
            ->orderBy('schedule_time', 'asc')
            ->get();

        // Group the schedules by date
        $schedules = $schedules->groupBy('schedule_date');
        return view('web.list_klinik', compact(['schedules', 'place']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.layanan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
