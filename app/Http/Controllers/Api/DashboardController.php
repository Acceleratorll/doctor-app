<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $doctor = User::with('employee')->where('role_id', 1)->first();
        return view('web.home', compact('doctor'));
    }
}
