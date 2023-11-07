<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\User;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function index()
    {
        $superadmins = User::with('employee')->where('role_id', 1)->get();
        return view('superadmin.index', compact('superadmins'));
    }

    public function edit($id)
    {
        $superadmin = User::findOrFail($id);
        return view('superadmin.edit', compact('superadmin'));
    }

    public function update($id, EmployeeRequest $request)
    {
        $superadmin = User::findOrFail($id);
        $input = $request->validated();
        $superadmin->update($input);
        $superadmin->employee->update($input);
        return redirect()->route('admin.dokter.index')->with('success', 'Superadmin successfully updated');
    }
}
