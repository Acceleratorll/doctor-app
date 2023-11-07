<?php

use App\Http\Controllers\AccessCodeController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeManageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ICDController;
use App\Http\Controllers\MedicalRecordManageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Pasien\AnnouncementController as PasienAnnouncementController;
use App\Http\Controllers\Pasien\ContactController;
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
use App\Http\Controllers\Pasien\JadwalController;
use App\Http\Controllers\Pasien\ProfileController;
use App\Http\Controllers\Pasien\ReservationController as PasienReservationController;
use App\Http\Controllers\PatientManageController;
use App\Http\Controllers\PlaceManageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScheduleManageController;
use App\Http\Controllers\SuperadminController;
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

Route::get('/dashboard', [PasienDashboardController::class, 'index'])->name('dashboard');

Route::get('/test-covid', function () {
    return view('web.tescovid');
})->name('test-covid');

Route::get('/konsultasi', function () {
    return view('web.konsultasi');
})->name('konsultasi');

Route::middleware(['auth','admin'])->prefix('/admin')->group(function () {
    Route::resources([
        '/dokter' => SuperadminController::class,
        '/pegawai' => EmployeeManageController::class,
        '/pasien' => PatientManageController::class,
        '/jadwal' => ScheduleManageController::class,
        '/medis' => MedicalRecordManageController::class,
        '/tempat' => PlaceManageController::class,
        '/reservation' => ReservationController::class,
        '/pengumuman' => AnnouncementController::class,
    ], ['as' => 'admin']);
    Route::get('/patient-reservations/{id}', [PatientManageController::class, 'getReservations'])->name('admin.patient.reservations');
    Route::get('/schedules/day', [DashboardController::class, 'getScheduleDay'])->name('admin.schedules.day');
    Route::get('/schedules/week', [DashboardController::class, 'getScheduleWeek'])->name('admin.schedules.week');
    Route::get('/schedules/month', [DashboardController::class, 'getScheduleMonth'])->name('admin.schedules.month');
    Route::get('/schedules/all', [DashboardController::class, 'tableDoctorsAll'])->name('admin.schedules.all');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::get('/tableSchedules', [DashboardController::class, 'tableSchedules'])->name('admin.table.schedules');
    Route::get('/tableDoctor', [DashboardController::class, 'tableDoctors'])->name('admin.table.doctors');
    Route::get('/tableDoctor/day', [DashboardController::class, 'tableDoctorsDay'])->name('admin.table.doctors.day');
    Route::get('/tableDoctor/week', [DashboardController::class, 'tableDoctorsWeek'])->name('admin.table.doctors.week');
    Route::get('/tableDoctor/month', [DashboardController::class, 'tableDoctorsMonth'])->name('admin.table.doctors.month');
    Route::get('/tableReservations/{patient}', [PatientManageController::class, 'tableReservations'])->name('admin.table.reservations');
    Route::get('/icd', [ICDController::class, 'index'])->name('icd.index');
    Route::post('/icd/search', [ICDController::class, 'search'])->name('icd.search');
    Route::post('/icd/show', [ICDController::class, 'detail'])->name('icd.show');
    Route::post('/storeMed', [ReservationController::class, 'storeMed'], ['as' => 'admin']);
    Route::get('/list-cancel', [ReservationController::class, 'cancel'], ['as' => 'admin']);
    Route::get('/waiting-list', [ReservationController::class, 'wait'])->name('admin.waiting-list');
    Route::put('/approve/{id}', [ReservationController::class, 'approve'])->name('admin.approve');
    Route::put('/restore/{id}', [ReservationController::class, 'restore'], ['as' => 'admin']);
    Route::put('/skip/{id}', [ReservationController::class, 'skip'])->name('admin.reservation.skip');
});

Route::get('/getEmployees', [EmployeeManageController::class, 'getEmployees'])->name('employees.get');
Route::get('/getReservations/{patient}', [ReservationController::class, 'getReservationsByPatient'])->name('reservations.get.by.patient');
Route::get('/getJsonReservations/{patient}', [ReservationController::class, 'getJsonReservationsByPatient'])->name('reservations.json.get.by.patient');
Route::get('/getIcd', [ICDController::class, 'getIcd'])->name('icd.get');
Route::get('/tableIcds', [ICDController::class, 'tableIcds'])->name('icd.table');
Route::get('/antrian/{id}', [ReservationController::class, 'getAntrian']);

Route::get('/download/{id}', [FileController::class, 'download'])->name('files.download');

Route::middleware(['auth', 'patient'])->group(function () {
    Route::resources([
        '/jadwal' => JadwalController::class,
        '/contact' => ContactController::class,
        '/profile' => ProfileController::class,
        '/reservasi' => PasienReservationController::class,
        '/profile' => ProfileController::class,
        '/pengumuman' => PasienAnnouncementController::class,
        '/code' => AccessCodeController::class,
    ]);
    Route::put('/saveCode', [AccessCodeController::class, 'saveCode'])->name('save.code');
    Route::get('/verifyCode', [AccessCodeController::class, 'verifyCode'])->name('verifyCode');
    Route::get('/confirm', [PasienReservationController::class, 'confirm']);
    Route::get('/bukti-pembayaran', [PasienReservationController::class, 'bukti']);
    Route::get('/cancel/{id}', [PasienReservationController::class, 'cancel']);
    Route::get('/getTime/{date}', [PasienReservationController::class, 'getTime']);
    Route::get('/jadwal-place/{place_id}', [JadwalController::class, 'schedulesByPlace'])->name('schedules.by.place');
    Route::get('/jadwal-rs', [JadwalController::class, 'indexRs']);
    Route::get('/jadwal-klinik', [JadwalController::class, 'indexKlinik']);
    Route::get('/notifikasi', [NotificationController::class, 'index']);
    Route::get('/notifikasi-remove/{id}', [NotificationController::class, 'destroy']);
});
Route::get('/lihat-antrian', [PasienReservationController::class, 'showQueue'])->name('show.queue');

Route::fallback(function () {
    return redirect()->route('dashboard');
});

require __DIR__ . '/auth.php';
