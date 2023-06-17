<?php

use App\Http\Controllers\EmployeeManageController;
use App\Http\Controllers\MedicalRecordManageController;
use App\Http\Controllers\Pasien\ContactController;
use App\Http\Controllers\Pasien\JadwalController;
use App\Http\Controllers\Pasien\ProfileController;
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


Route::middleware(['auth', 'patient'])->group(function () {
    Route::resources([
        '/jadwal' => JadwalController::class,
        '/contact' => ContactController::class,
        '/profile' => ProfileController::class,
    ]);
});

Route::fallback(function () {
    return redirect()->route('dashboard');
});

require __DIR__ . '/auth.php';
