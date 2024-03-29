<?php

use App\Http\Controllers;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\MedicalRecordsController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\PushNotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'status_code' => 200,
        'message' => 'Welcome to the Mobile API'
    ]);
});


Route::controller(AuthController::class)->prefix('auth')->group(
    function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
    }
);


Route::middleware('auth:sanctum')->group(
    function () {
        Route::get('/test', function () {
            return 'test';
        });
        Route::controller(AuthController::class)->prefix('auth')->group(
            function () {
                Route::post('/logout', 'logout');
                Route::get('/me', 'me');
                Route::post('/update_password', 'updatePassword');
                Route::post('/update_profile', 'updateProfile');
            }
        );

        Route::controller(DoctorController::class)->prefix('doctor')->group(
            function () {
                Route::get('/all', 'getAllDoctors');
                Route::get('/detail/{id}', 'getDoctorById');
                Route::get('/places/{id}', 'getPlacesOfDoctorById');
                Route::get('/schedule', 'getDoctorSchedules');
                Route::get('/my_schedule', 'getMySchedules');
                Route::post('/schedule/create', 'createDoctorSchedule');
                Route::post('/schedule/update', 'updateDoctorSchedule');
                Route::post('/schedule/delete', 'deleteDoctorSchedule');
            }
        );

        Route::controller(ReservationController::class)->prefix('reservation')->group(
            function () {
                Route::post('/book', 'bookDoctor');
                Route::get('/my', 'getMyReservations');
                Route::get('/detail/{id}', 'getReservationDetailById');
                Route::get('/today', 'getTodayReservations');
                Route::get('/today_total', 'getTodayReservationsTotal');
                Route::get('/all', 'getAllReservations');
                Route::post('/approve', 'approveOrRejectReservation');
                Route::get('/quota/{id}', 'getRemainingQuota');
            }
        );

        Route::controller(AnnouncementController::class)->prefix('announcement')->group(
            function () {
                Route::get('/all', 'getAllAnnouncement');
                Route::get('/detail/{id}', 'getAnnouncementById');
                Route::post('/create', 'createAnnouncement');
                Route::post('/update', 'updateAnnouncement');
                Route::post('/delete', 'deleteAnnouncement');
            }
        );

        Route::controller(MedicalRecordsController::class)->prefix('medical_record')->group(
            function () {
                Route::get('/icds', 'getICDS');
                Route::post('/add', 'addMedicalRecord');
                Route::get('/my', 'getMyMedicalRecords');
            }
        );
        Route::controller(PatientController::class)->prefix('patient')->group(
            function () {
                Route::get('/all', 'getAllPatients');
                Route::post('/update_access_code', 'updateAccessCode');
            }
        );
        Route::controller(NotificationController::class)->prefix('notification')->group(
            function () {
                Route::get('/all', 'getAllNotif');
                Route::post('/read', 'readNotif');
            }
        );

        Route::controller(PlaceController::class)->prefix('place')->group(
            function () {
                Route::get('/my', 'myPlace');
                Route::post('/create', 'createPlace');
                Route::post('/update', 'updatePlace');
                Route::post('/delete', 'deletePlace');
            }
        );

    }
);
