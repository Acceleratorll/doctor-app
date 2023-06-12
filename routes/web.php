<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeManageController;
use App\Http\Controllers\MedicalRecordManageController;
use App\Http\Controllers\PatientManageController;
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

Route::middleware(['auth', 'admin'])->prefix('/admin')->group(function () {
    Route::resources([
        '/jadwal' => ScheduleManageController::class,
        '/medis' => MedicalRecordManageController::class,
        '/pasien' => PatientManageController::class,
        '/pegawai' => EmployeeManageController::class,
    ], ['as' => 'admin']);
});

// Route::get('/sch', [ScheduleManageController::class, 'index']);

require __DIR__ . '/auth.php';
