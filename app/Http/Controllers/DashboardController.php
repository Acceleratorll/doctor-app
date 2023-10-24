<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard');
    }

    public function tableSchedules()
    {
        $schedules = Schedule::with('employee', 'reservations.patient')->orderBy('schedule_date', 'desc')->get();
        return DataTables::of($schedules)
            ->addColumn('doctor', function ($schedule) {
                return $schedule->employee->user->name;
            })
            ->addColumn('qualification', function ($schedule) {
                return $schedule->employee->qualification;
            })
            ->addColumn('date', function ($schedule) {
                return Carbon::parse($schedule->schedule_date)->format('Y-m-d');
            })
            ->addColumn('time', function ($schedule) {
                return $schedule->schedule_time . ' ' . $schedule->schedule_time_end;
            })
            ->addColumn('place', function ($schedule) {
                return $schedule->place->name;
            })
            ->addColumn('qty', function ($schedule) {
                return $schedule->qty;
            })
            ->addColumn('qty_left', function ($schedule) {
                return ($schedule->qty - $schedule->reservations->where('approve', 1)->count());
            })
            ->addColumn('action', 'partials.button-table.schedule-action')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getScheduleDay()
    {
        $day = now()->day;
        $schedules = Schedule::with('employee', 'reservations.patient')
            ->whereDay('schedule_date', $day)
            ->orderBy('schedule_date', 'desc')
            ->get();

        return DataTables::of($schedules)
            ->addColumn('doctor', function ($schedule) {
                return $schedule->employee->user->name;
            })
            ->addColumn('qualification', function ($schedule) {
                return $schedule->employee->qualification;
            })
            ->addColumn('date', function ($schedule) {
                return Carbon::parse($schedule->schedule_date)->format('Y-m-d');
            })
            ->addColumn('time', function ($schedule) {
                return $schedule->schedule_time . ' ' . $schedule->schedule_time_end;
            })
            ->addColumn('place', function ($schedule) {
                return $schedule->place->name;
            })
            ->addColumn('qty', function ($schedule) {
                return $schedule->qty;
            })
            ->addColumn('qty_left', function ($schedule) {
                return ($schedule->qty - $schedule->reservations->where('approve', 1)->count());
            })
            ->addColumn('action', 'partials.button-table.schedule-action')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getScheduleWeek()
    {
        $schedules = Schedule::with('employee', 'reservations.patient')
            ->whereDate('schedule_date', '>=', now()->startOfWeek())
            ->whereDate('schedule_date', '<=', now()->endOfWeek())
            ->orderBy('schedule_date', 'desc')
            ->get();

        return DataTables::of($schedules)
            ->addColumn('doctor', function ($schedule) {
                return $schedule->employee->user->name;
            })
            ->addColumn('qualification', function ($schedule) {
                return $schedule->employee->qualification;
            })
            ->addColumn('date', function ($schedule) {
                return Carbon::parse($schedule->schedule_date)->format('Y-m-d');
            })
            ->addColumn('time', function ($schedule) {
                return $schedule->schedule_time . ' ' . $schedule->schedule_time_end;
            })
            ->addColumn('place', function ($schedule) {
                return $schedule->place->name;
            })
            ->addColumn('qty', function ($schedule) {
                return $schedule->qty;
            })
            ->addColumn('qty_left', function ($schedule) {
                return ($schedule->qty - $schedule->reservations->where('approve', 1)->count());
            })
            ->addColumn('action', 'partials.button-table.schedule-action')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getScheduleMonth()
    {
        $month = now()->month;
        $schedules = Schedule::with('employee', 'reservations.patient')
            ->whereMonth('schedule_date', $month)
            ->orderBy('schedule_date', 'desc')
            ->get();

        return DataTables::of($schedules)
            ->addColumn('doctor', function ($schedule) {
                return $schedule->employee->user->name;
            })
            ->addColumn('qualification', function ($schedule) {
                return $schedule->employee->qualification;
            })
            ->addColumn('date', function ($schedule) {
                return Carbon::parse($schedule->schedule_date)->format('Y-m-d');
            })
            ->addColumn('time', function ($schedule) {
                return $schedule->schedule_time . ' ' . $schedule->schedule_time_end;
            })
            ->addColumn('place', function ($schedule) {
                return $schedule->place->name;
            })
            ->addColumn('qty', function ($schedule) {
                return $schedule->qty;
            })
            ->addColumn('qty_left', function ($schedule) {
                return ($schedule->qty - $schedule->reservations->where('approve', 1)->count());
            })
            ->addColumn('action', 'partials.button-table.schedule-action')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function tableDoctors()
    {
        $employees = Employee::with('schedules.reservations.patient', 'user')->orderBy('created_at', 'desc')->get();
        return DataTables::of($employees)
            ->addColumn('doctor', function ($employee) {
                return $employee->user->name;
            })
            ->addColumn('qualification', function ($employee) {
                return $employee->qualification;
            })
            ->addColumn('total', function ($employee) {
                return $employee->schedules->sum(function ($schedule) {
                    return $schedule->reservations->where('approve', 1)->count();
                });
            })
            ->make(true);
    }

    public function tableDoctorsDay()
    {
        $day = now()->day;
        $employees = Employee::with('schedules.reservations.patient', 'user')
            ->whereHas('schedules', function ($query) use ($day) {
                $query->whereDay('schedule_date', $day);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return DataTables::of($employees)
            ->addColumn('doctor', function ($employee) {
                return $employee->user->name;
            })
            ->addColumn('qualification', function ($employee) {
                return $employee->qualification;
            })
            ->addColumn('total', function ($employee) {
                return $employee->schedules->sum(function ($schedule) {
                    return $schedule->reservations->where('approve', 1)->count();
                });
            })
            ->make(true);
    }

    public function tableDoctorsWeek()
    {
        $employees = Employee::with('schedules.reservations.patient', 'user')
            ->whereHas('schedules', function ($query) {
                $query->whereDate('schedule_date', '>=', now()->startOfWeek())
                    ->whereDate('schedule_date', '<=', now()->endOfWeek());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return DataTables::of($employees)
            ->addColumn('doctor', function ($employee) {
                return $employee->user->name;
            })
            ->addColumn('qualification', function ($employee) {
                return $employee->qualification;
            })
            ->addColumn('total', function ($employee) {
                return $employee->schedules->sum(function ($schedule) {
                    return $schedule->reservations->where('approve', 1)->count();
                });
            })
            ->make(true);
    }
    public function tableDoctorsMonth()
    {
        $month = now()->month;
        $employees = Employee::with('schedules.reservations.patient', 'user')
            ->whereHas('schedules', function ($query) use ($month) {
                $query->whereMonth('schedule_date', $month);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return DataTables::of($employees)
            ->addColumn('doctor', function ($employee) {
                return $employee->user->name;
            })
            ->addColumn('qualification', function ($employee) {
                return $employee->qualification;
            })
            ->addColumn('total', function ($employee) {
                return $employee->schedules->sum(function ($schedule) {
                    return $schedule->reservations->where('approve', 1)->count();
                });
            })
            ->make(true);
    }
}
