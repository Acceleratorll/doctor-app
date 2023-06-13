<?php

use App\Http\Controllers\EmployeeManageController;
use App\Http\Controllers\MedicalRecordManageController;
use App\Http\Controllers\Pasien\ContactController;
use App\Http\Controllers\Pasien\JadwalController;
use App\Http\Controllers\Pasien\ProfileController;
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
    return view('web.home');
})->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('/admin')->group(function () {
    Route::resources([
        '/jadwal' => ScheduleManageController::class,
        '/medis' => MedicalRecordManageController::class,
        '/pasien' => PatientManageController::class,
        '/pegawai' => EmployeeManageController::class,
    ], ['as' => 'admin']);
});


Route::middleware(['auth', 'patient'])->group(function () {
    Route::get('schedule/{employee_id}', [ScheduleManageController::class, 'get_schedule_by_employee_id']);
    Route::post('reservation/finish/{reservation}', [ReservationController::class, 'finish']);
    Route::get('reservation/view', [ReservationController::class, 'reservation_view']);
    Route::resources([
        '/jadwal' => JadwalController::class,
        '/contact' => ContactController::class,
        '/profile' => ProfileController::class,
    ]);
});

require __DIR__ . '/auth.php';
