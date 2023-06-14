<?php

use App\Http\Controllers\EmployeeManageController;
use App\Http\Controllers\MedicalRecordManageController;
use App\Http\Controllers\PatientManageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScheduleManageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('welcome');
});


Route::get('/reservation/check_queue', [ReservationController::class, 'check_queue']);
Route::get('reservation/view', [ReservationController::class, 'reservation_view']);
Route::get('reservation/create', [ReservationController::class, 'create']);
Route::post('reservation', [ReservationController::class, 'store']);
Route::get('schedule/{employee_id}', [ScheduleManageController::class, 'get_schedule_by_employee_id']);
Route::get('reservation/queue', [ReservationController::class, 'queue']);


Route::middleware(['auth', 'admin'])->prefix('/admin')->group(function () {
    Route::resources([
        '/jadwal' => ScheduleManageController::class,
        '/medis' => MedicalRecordManageController::class,
        '/pasien' => PatientManageController::class,
        '/pegawai' => EmployeeManageController::class,
    ], ['as' => 'admin']);
    Route::get('/schedule/{employee_id}', [ScheduleManageController::class, 'get_schedule_by_employee_id'], ['as' => 'admin']);
    Route::post('/reservation/finish/{reservation}', [ReservationController::class, 'finish'], ['as' => 'admin']);
});

require __DIR__ . '/auth.php';
