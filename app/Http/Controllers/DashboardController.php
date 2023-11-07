<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\User;
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
        $schedules = Schedule::withCount('reservations')
            ->whereHas('reservations', function ($q) {
                $q->where('status', 1);
            })
            ->get();

        return DataTables::of($schedules)
            ->addColumn('filter', function ($schedule) {
                return Carbon::parse($schedule->schedule_date)->format('d M')
                    . ' Jam ' .
                    Carbon::parse($schedule->schedule_time)->format('H:i')
                    . ' - ' .
                    Carbon::parse($schedule->schedule_time_end)->format('H:i');
            })
            ->addColumn('total', function ($schedule) {
                return $schedule->reservations_count;
            })
            ->make(true);
    }

    public function tableDoctorsDay()
    {
        $schedules = Schedule::with('reservations')
            ->whereHas('reservations', function ($q) {
                $q->where('status', 1);
            })
            ->get();

        // Group schedules by schedule date
        $groupedSchedules = $schedules->groupBy(function ($schedule) {
            return $schedule->schedule_date;
        });

        // Calculate total reservations for each day
        $data = $groupedSchedules->map(function ($daySchedules) {
            return [
                'filter' => $daySchedules->first()->schedule_date,
                'total' => $daySchedules->sum(function ($schedule) {
                    return $schedule->reservations->count();
                }),
            ];
        });

        return DataTables::of($data)->make(true);
    }

    public function tableDoctorsWeek()
    {
        $schedules = Schedule::with('reservations')
            ->whereHas('reservations', function ($q) {
                $q->where('status', 1);
            })
            ->get();

        // Group schedules by week using the week number
        $groupedSchedules = $schedules->groupBy(function ($schedule) {
            return Carbon::parse($schedule->schedule_date)->format('W');
        });

        // Calculate total reservations for each week
        $data = $groupedSchedules->map(function ($weekSchedules, $weekNumber) {
            return [
                'filter' => 'Week ' . $weekNumber,
                'total' => $weekSchedules->sum(function ($schedule) {
                    return $schedule->reservations->count();
                }),
            ];
        });

        return DataTables::of($data)->make(true);
    }


    public function tableDoctorsMonth()
    {
        $schedules = Schedule::with('reservations')
            ->whereHas('reservations', function ($q) {
                $q->where('status', 1);
            })
            ->get();

        // Group schedules by month using the month and year
        $groupedSchedules = $schedules->groupBy(function ($schedule) {
            return Carbon::parse($schedule->schedule_date)->format('Y-m');
        });

        // Calculate total reservations for each month
        $data = $groupedSchedules->map(function ($monthSchedules, $monthYear) {
            return [
                'filter' => date('F Y', strtotime($monthYear)),
                'total' => $monthSchedules->sum(function ($schedule) {
                    return $schedule->reservations->count();
                }),
            ];
        });

        return DataTables::of($data)->make(true);
    }

    public function tableDoctorsAll()
    {
        $totalReservations = Reservation::where('status', 1)->count();

        return DataTables::of([$totalReservations])
            ->addColumn('filter', 'All of Time')
            ->addColumn('total', function () use ($totalReservations) {
                return $totalReservations;
            })
            ->make(true);
    }
}
