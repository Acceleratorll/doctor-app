<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeManageController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->get();
        return view('pegawai.index', compact('employees'));
    }

    public function getEmployees(Request $request)
    {
        $searchTerm = $request->term;

        $employees = Employee::with('user')->whereHas('user', function ($query) use ($searchTerm) {
            $query->where('name', 'LIKE', "%$searchTerm%");
        })->get();

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
            'role_id' => $input['role_id'],
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
        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil ditambahkan !');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $employee = Employee::with('user')->findOrFail($id);
        return view('pegawai.edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, $id)
    {
        $patient = Employee::findOrFail($id);
        $input = $request->validated();
        $user = User::findOrFail($patient->user_id);
        $user->update([
            'role_id' => $input['role_id'],
            'name' => $input['name'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'birth_date' => $input['birth_date'],
            'gender' => $input['gender'],
            'email' => $input['email'],
            'username' => $input['username'],
            'password' => bcrypt($input['password']),
        ]);

        $patient->update([
            'user_id' => $user->id,
            'qualification' => $input['qualification'],
        ]);
        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil diupdate !');
    }

    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();
        return back()->with('success', 'Pegawai berhasil dihapus !');
    }
}
