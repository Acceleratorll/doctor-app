<?php

use App\Http\Controllers\AccessCodeController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\EmployeeManageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ICDController;
use App\Http\Controllers\MedicalRecordManageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Pasien\AnnouncementController as PasienAnnouncementController;
use App\Http\Controllers\Pasien\ContactController;
use App\Http\Controllers\Pasien\DashboardController;
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
        '/pengumuman' => AnnouncementController::class,
    ], ['as' => 'admin']);
    Route::get('/icd', [ICDController::class, 'index'])->name('icd.index');
    // Route::get('/icd/detail', [ICDController::class, 'detail'])->name('icd.detail');
    Route::post('/icd/show', [ICDController::class, 'detail'])->name('icd.show');
    Route::post('/icd/search', [ICDController::class, 'search'])->name('icd.search');
    Route::post('/storeMed', [ReservationController::class, 'storeMed'], ['as' => 'admin']);
    Route::get('/list-cancel', [ReservationController::class, 'cancel'], ['as' => 'admin']);
    Route::get('/waiting-list', [ReservationController::class, 'wait'])->name('admin.waiting-list');
    Route::put('/approve/{id}', [ReservationController::class, 'approve'])->name('admin.approve');
    Route::put('/restore/{id}', [ReservationController::class, 'restore'], ['as' => 'admin']);
});
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
    Route::put('/saveCode', [AccessCodeController::class, 'saveCode']);
    Route::get('/verifyCode', [AccessCodeController::class, 'verifyCode'])->name('verifyCode');
    Route::get('/confirm', [PasienReservationController::class, 'confirm']);
    Route::get('/bukti-pembayaran', [PasienReservationController::class, 'bukti']);
    Route::get('/cancel/{id}', [PasienReservationController::class, 'cancel']);
    Route::get('/getTime/{date}', [PasienReservationController::class, 'getTime']);
    Route::get('/jadwal-rs', [JadwalController::class, 'indexRs']);
    Route::get('/jadwal-klinik', [JadwalController::class, 'indexKlinik']);
    Route::get('/notifikasi', [NotificationController::class, 'index']);
    Route::get('/notifikasi-remove/{id}', [NotificationController::class, 'destroy']);
});

// Route::fallback(function () {
//     return redirect()->route('dashboard');
// });

require __DIR__ . '/auth.php';
