<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return response()->json($schedules);
    }

    public function show($id)
    {
        $schedule = Schedule::findOrFile($id);
        return response()->json($schedule);
    }
}
