<?php

use App\Http\Controllers\MedicalRecordManageController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resources([
    'jadwal' => ScheduleManageController::class,
    'rekam-medis' => MedicalRecordManageController::class,
]);
