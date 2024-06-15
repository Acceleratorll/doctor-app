<?php

namespace App\Http\Controllers;

use App\Models\ScheduleType;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getByScheduleType($id)
    {
        $type = ScheduleType::findOrFail($id)->name;

        if ($type == 'Gigi') {
            $type = ['dokter_gigi'];
        } else if ($type == 'Umum') {
            $type = ['dokter_umum'];
        }

        $users = User::with('employee')->role($type)->get();

        return response()->json($users);
    }

    public function showChangePasswordForm($id)
    {
        $user = User::find($id);
        return view('user.change-password', compact('user'));
    }

    public function changePassword(Request $request, $id)
    {
        if($request->password != $request->password_confirmation){
            return redirect()->back()->with('error', 'Password does not match!');
        }

        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('admin.dashboard.index')->with('success', 'Password changed successfully');
    }
}
