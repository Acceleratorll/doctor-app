<?php

use App\Http\Controllers\Api\JadwalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
});

// Route::middleware(['auth', 'admin'])->prefix('/api/admin')->group(function () {
// Route::prefix('/admin')->group(function () {
//     Route::resources([
//         '/jadwal' => JadwalController::class,
//         '/medis' => MedicalRecordManageController::class,
//         '/pasien' => PatientManageController::class,
//         '/pegawai' => EmployeeManageController::class,
//         '/tempat' => PlaceManageController::class,
//         '/reservation' => ReservationController::class,
//     ], ['as' => 'api.admin']);
//     Route::post('/storeMed', [ReservationController::class, 'storeMed'], ['as' => 'api.admin']);
// });
