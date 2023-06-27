<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDO;

class DashboardController extends Controller
{
    public function index()
    {
        $doctor = User::with('employee')->where('role_id', 1)->first();
        return view('web.home', compact('doctor'));
    }
}
