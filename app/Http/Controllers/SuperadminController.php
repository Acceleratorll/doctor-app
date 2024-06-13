<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\User;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function index()
    {
        $superadmins = User::with('employee')->role('superadmin')->get();
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
        $superadmin->update([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'birth_date' => $input['birth_date'],
            'gender' => $input['gender'],
            'email' => $input['email'],
            'username' => $input['username'],
        ]);

        $superadmin->employee->update($input);

        $superadmin->syncRoles($input['role']);

        return redirect()->route('admin.dokter.index')->with('success', 'Superadmin successfully updated');
    }
}
