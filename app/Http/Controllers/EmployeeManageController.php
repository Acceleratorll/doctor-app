<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Announcement;
use App\Models\Employee;
use App\Models\Place;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeManageController extends Controller
{
    public function index()
    {
        $employees = User::withoutRole(['pasien', 'superadmin'])->get();
        return view('pegawai.index', compact('employees'));
    }

    public function getEmployees(Request $request)
    {
        $searchTerm = $request->term;

        $employees = User::with('role')->where('name', 'LIKE', "%$searchTerm%")
            ->get();

        $formattedEmployees = $employees->map(function ($employee) {
            return [
                'id' => $employee->id,
                'text' => $employee->user->name,
            ];
        });

        return response()->json($formattedEmployees);
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(EmployeeRequest $request)
    {
        $input = $request->validated();
        $user = User::create([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'birth_date' => $input['birth_date'],
            'gender' => $input['gender'],
            'email' => $input['email'],
            'username' => $input['username'],
            'password' => bcrypt($input['password']),
        ]);

        Employee::create([
            'user_id' => $user->id,
            'qualification' => $input['qualification'],
        ]);

        $user->syncRoles($input['role']);

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil ditambahkan !');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $employee = User::findOrFail($id);
        return view('pegawai.edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, $id)
    {
        $employee = User::findOrFail($id);
        $input = $request->validated();
        $employee->update([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'birth_date' => $input['birth_date'],
            'gender' => $input['gender'],
            'email' => $input['email'],
            'username' => $input['username'],
        ]);

        $employee->syncRoles($input['role']);
        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil diupdate !');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Schedule::where('employee_id', $user->employee->id)->update([
            'employee_id' => 1
        ]);

        Place::where('employee_id', $user->employee->id)->update([
            'employee_id' => 1
        ]);

        Announcement::where('employee_id', $user->employee->id)->update([
            'employee_id' => 1
        ]);

        $user->forceDelete();
        return back()->with('success', 'Pegawai berhasil dihapus !');
    }
}
