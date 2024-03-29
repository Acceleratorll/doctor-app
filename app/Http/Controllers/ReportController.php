<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Place;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function recipes()
    {
        return view('report.recipes');
    }
    public function cetakRecipes()
    {
        $cetakData = MedicalRecord::with('reservation.patient.user');
        $cetakData = $cetakData->orderBy('updated_at', 'desc')->get();
        return view('report.printrecipes', compact('cetakData'));
    }

    public function visitors()
    {
        return view('report.visitors');
    }
    public function cetakVisitors()
    {
        $cetakData = Reservation::with('patient.user', 'schedule.place')->where('approve', 1)->where('status', 2);
        $cetakData = $cetakData->orderBy('updated_at', 'desc')->get();
        return view('report.printvisitors', compact('cetakData'));
    }

    public function opens()
    {
        return view('report.opens');
    }
    public function cetakOpens()
    {
        $cetakData = Place::with('schedules.reservations');
        $cetakData = $cetakData->orderBy('updated_at', 'desc')->get();
        return view('report.printopens', compact('cetakData'));
    }
    public function doctors()
    {
        return view('report.doctors');
    }

    public function getRecipes(Request $request)
    {
        $data = MedicalRecord::with('reservation.patient.user');
        $doctor = User::where('role_id', 1)->first();

        if ($request->filter == 'day') {
            $data = $data->whereDate('updated_at', now()->toDateString());
        } else if ($request->filter == 'week') {
            $data = $data->whereDate('updated_at', '>=', now()->startOfWeek())
                ->whereDate('updated_at', '<=', now()->endOfWeek());
        } else if ($request->filter == 'month') {
            $data = $data->whereMonth('updated_at', now()->month);
        } else if ($request->filled('min') && $request->filled('max')) {
            $data = $data->whereBetween('updated_at', [$request->input('min'), $request->input('max')]);
        } else if ($request->filled('min')) {
            $data = $data->where('updated_at', '>=', $request->input('min'));
        } else if ($request->filled('max')) {
            $data = $data->where('updated_at', '<=', $request->input('max'));
        }

        $data = $data->orderBy('updated_at', 'desc')->get();

        return DataTables::of($data)
            ->addColumn('id', function ($item) {
                return $item->id;
            })
            ->addColumn('patientName', function ($item) {
                return $item->reservation->patient->user->name;
            })
            ->addColumn('doctorName', function () use ($doctor) {
                return $doctor->name;
            })
            ->addColumn('date', function ($item) {
                return Carbon::parse($item->updated_at)->format('l, Y-m-d');
            })
            ->addColumn('recipe', function ($item) {
                return $item->recipe;
            })
            ->make(true);
    }

    public function getDoctors(Request $request)
    {
        $data = User::with('employee.schedules.reservations')->where('role_id', 1);

        if ($request->filter == 'day') {
            $data = $data->whereHas('employee', function ($query) {
                $query->whereHas('schedules', function ($q) {
                    $q->whereDate('schedule_date', now()->toDateString());
                });
            });
        } else if ($request->filter == 'week') {
            $data = $data->whereHas('employee', function ($query) {
                $query->whereHas('schedules', function ($q) {
                    $q->whereDate('schedule_date', '>=', now()->startOfWeek())
                        ->whereDate('schedule_date', '<=', now()->endOfWeek());
                });
            });
        } else if ($request->filter == 'month') {
            $data = $data->whereHas('employee', function ($query) {
                $query->whereHas('schedules', function ($q) {
                    $q->whereMonth('schedule_date', now()->month);
                });
            });
        }

        $data = $data->orderBy('updated_at', 'desc')->get();

        return DataTables::of($data)
            ->addColumn('id', function ($item) {
                return $item->id;
            })
            ->addColumn('name', function ($item) {
                return $item->name;
            })
            ->addColumn('patientTotal', function ($item) {
                // $reservations =
                //     $item->whereHas('employee', function ($query) {
                //         $query->whereHas('schedules', function ($q) {
                //             $q->reservations;
                //         });
                //     });
                // return $reservations->count();
                return $item->employee->schedules->flatMap->reservations->count();
            })
            ->make(true);
    }

    public function getOpens(Request $request)
    {
        $data = Place::with('schedules.reservations');

        if ($request->filter == 'day') {
            $data = $data->whereHas('schedules', function ($query) {
                $query->whereDate('schedule_date', now()->toDateString());
            });
        } else if ($request->filter == 'week') {
            $data = $data->whereHas('schedules', function ($query) {
                $query->whereDate('schedule_date', '>=', now()->startOfWeek())
                    ->whereDate('schedule_date', '<=', now()->endOfWeek());
            });
        } else if ($request->filter == 'month') {
            $data = $data->whereHas('schedules', function ($query) {
                $query->whereMonth('schedule_date', now()->month);
            });
        } else if ($request->filled('min') && $request->filled('max')) {
            $data = $data->whereHas('schedules', function ($q) use ($request) {
                $q->whereBetween('schedule_date', [$request->input('min'), $request->input('max')]);
            });
        } else if ($request->filled('min')) {
            $data = $data->whereHas('schedules', function ($q) use ($request) {
                $q->where('schedule_date', '>=', $request->input('min'));
            });
        } else if ($request->filled('max')) {
            $data = $data->whereHas('schedules', function ($q) use ($request) {
                $q->where('schedule_date', '<=', $request->input('max'));
            });
        }

        $data = $data->orderBy('updated_at', 'desc')->get();
        dd($data);

        return DataTables::of($data)
            ->addColumn('id', function ($item) {
                return $item->id;
            })
            ->addColumn('name', function ($item) {
                return $item->name;
            })
            ->addColumn('openTotal', function ($item) {
                return $item->schedules->count() ?? 0;
            })
            ->addColumn('patientTotal', function ($item) {
                $reservations = $item->schedules->flatMap(function ($schedule) {
                    return $schedule->reservations;
                });

                $totalReservations = $reservations->count();

                return $totalReservations;
            })
            ->make(true);
    }

    public function getVisitors(Request $request)
    {
        $data = Reservation::with('patient.user', 'schedule.place')->where('approve', 1)->where('status', 2);

        if ($request->filter == 'day') {
            $data = $data->whereHas('schedule', function ($query) {
                $query->whereDate('schedule_date', now()->toDateString());
            });
        } else if ($request->filter == 'week') {
            $data = $data->whereHas('schedule', function ($query) {
                $query->whereDate('schedule_date', '>=', now()->startOfWeek())
                    ->whereDate('schedule_date', '<=', now()->endOfWeek());
            });
        } else if ($request->filter == 'month') {
            $data = $data->whereHas('schedule', function ($query) {
                $query->whereMonth('schedule_date', now()->month);
            });
        }

        if ($request->filled('min') && $request->filled('max')) {
            $data = $data->whereHas('schedule', function ($q) use ($request) {
                $q->whereBetween('schedule_date', [$request->input('min'), $request->input('max')]);
            });
        } else if ($request->filled('min')) {
            $data = $data->whereHas('schedule', function ($q) use ($request) {
                $q->where('schedule_date', '>=', $request->input('min'));
            });
        } else if ($request->filled('max')) {
            $data = $data->whereHas('schedule', function ($q) use ($request) {
                $q->where('schedule_date', '<=', $request->input('max'));
            });
        }

        $data = $data->orderBy('updated_at', 'desc')->get();

        return DataTables::of($data)
            ->addColumn('patient_id', function ($item) {
                return $item->patient_id;
            })
            ->addColumn('name', function ($item) {
                return $item->patient->user->name;
            })
            ->addColumn('date', function ($item) {
                return Carbon::parse($item->updated_at)->format('l, Y-m-d');
            })
            ->addColumn('schedule_date', function ($item) {
                return Carbon::parse($item->schedule->schedule_date)->format('l, Y-m-d');
            })
            ->make(true);
    }
}
