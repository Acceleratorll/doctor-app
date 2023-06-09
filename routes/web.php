<?php

use App\Http\Controllers\EmployeeManageController;
use App\Http\Controllers\MedicalRecordManageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Pasien\ContactController;
use App\Http\Controllers\Pasien\DashboardController;
use App\Http\Controllers\Pasien\JadwalController;
use App\Http\Controllers\Pasien\ProfileController;
use App\Http\Controllers\Pasien\ReservationController as PasienReservationController;
use App\Http\Controllers\PatientManageController;
use App\Http\Controllers\PlaceManageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScheduleManageController;
use App\Models\User;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/test-covid', function () {
    return view('web.tescovid');
})->name('test-covid');

Route::get('/konsultasi', function () {
    return view('web.konsultasi');
})->name('konsultasi');

Route::middleware(['auth', 'admin'])->prefix('/admin')->group(function () {
    Route::resources([
        '/jadwal' => ScheduleManageController::class,
        '/medis' => MedicalRecordManageController::class,
        '/pasien' => PatientManageController::class,
        '/pegawai' => EmployeeManageController::class,
        '/tempat' => PlaceManageController::class,
        '/reservation' => ReservationController::class,
    ], ['as' => 'admin']);
    Route::post('/storeMed', [ReservationController::class, 'storeMed'], ['as' => 'admin']);
});
Route::get('/antrian/{id}', [ReservationController::class, 'getAntrian']);


Route::middleware(['auth', 'patient'])->group(function () {
    Route::resources([
        '/jadwal' => JadwalController::class,
        '/contact' => ContactController::class,
        '/profile' => ProfileController::class,
        '/reservasi' => PasienReservationController::class,
    ]);
    Route::get('/confirm', [PasienReservationController::class, 'confirm']);
    Route::get('/getTime/{date}', [PasienReservationController::class, 'getTime']);
    Route::get('/jadwal-rs', [JadwalController::class, 'indexRs']);
    Route::get('/jadwal-klinik', [JadwalController::class, 'indexKlinik']);
    Route::get('/notifikasi', [NotificationController::class, 'index']);
    Route::get('/notifikasi-remove/{id}', [NotificationController::class, 'destroy']);
});

Route::fallback(function () {
    return redirect()->route('dashboard');
});

require __DIR__ . '/auth.php';
