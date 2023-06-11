<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeManageController;
use App\Http\Controllers\MedicalRecordManageController;
use App\Http\Controllers\PatientManageController;
use App\Http\Controllers\ScheduleManageController;
use App\Http\Controllers\ReservationController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('reservation/view', [ReservationController::class, 'reservation_view'])->middleware('auth:patient');
Route::middleware('auth:patient')->group(function () {
    Route::resources([
        'jadwal' => ScheduleManageController::class,
        'medis' => MedicalRecordManageController::class,
        'pasien' => PatientManageController::class,
        'pegawai' => EmployeeManageController::class,
        'reservation' => ReservationController::class
    ]);
});


Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::get('/register', [AuthController::class, 'login'])->name('register');

Route::get('schedule/{employee_id}', [ScheduleManageController::class, 'get_schedule_by_employee_id']);
Route::post('reservation/finish/{reservation}', [ReservationController::class, 'finish']);
// Route::get('notif/{notif}', [NotificationController::class, 'notif']);
