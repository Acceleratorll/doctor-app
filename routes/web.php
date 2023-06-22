<?php

use App\Http\Controllers\EmployeeManageController;
use App\Http\Controllers\MedicalRecordManageController;
use App\Http\Controllers\Pasien\ContactController;
use App\Http\Controllers\Pasien\JadwalController;
use App\Http\Controllers\Pasien\ProfileController;
use App\Http\Controllers\Pasien\ReservationController as PasienReservationController;
use App\Http\Controllers\PatientManageController;
use App\Http\Controllers\PlaceManageController;
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

Route::get('/reservasi/create', function () {
    return view('web.janji_temu');
})->name('janji_temu');

Route::middleware(['auth', 'admin'])->prefix('/admin')->group(function () {
    Route::resources([
        '/jadwal' => ScheduleManageController::class,
        '/medis' => MedicalRecordManageController::class,
        '/pasien' => PatientManageController::class,
        '/pegawai' => EmployeeManageController::class,
        '/tempat' => PlaceManageController::class,
        '/reservation' => ReservationController::class,
    ], ['as' => 'admin']);
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
});

Route::fallback(function () {
    return redirect()->route('dashboard');
});

require __DIR__ . '/auth.php';
