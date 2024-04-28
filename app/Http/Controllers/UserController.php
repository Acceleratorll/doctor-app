<?php

namespace App\Http\Controllers;

use App\Models\ScheduleType;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getByScheduleType($id)
    {
        $type = ScheduleType::findorFail($id)->name;

        if ($type == 'Gigi') {
            $type = ['dokter_gigi'];
        } else if ($type == 'Umum') {
            $type = ['dokter_umum'];
        }

        $users = User::with('employee')->role($type)->get();

        return response()->json($users);
    }
}
