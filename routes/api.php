<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\ExaminationController;
use App\Http\Controllers\Api\MedicineController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SpecialtyController;

use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/me', [AuthController::class, 'me']);

    Route::middleware('permission')->group(function () {

        //User
        Route::apiResource('users', UserController::class);
        Route::patch('/users/{user}/status',
            [UserController::class, 'updateStatus']
        );

        //Specialty
        Route::apiResource('specialties', SpecialtyController::class);
        
        //Doctor
        Route::apiResource('doctors', DoctorController::class);

        //Patient
        Route::apiResource('patients', PatientController::class);

        //Appointment
        Route::apiResource('appointments', AppointmentController::class);
        Route::patch('/appointments/{appointment}/status',
            [AppointmentController::class, 'updateStatus']
        );

        //Examination
        Route::apiResource('examinations', ExaminationController::class);

        //Medicine
        Route::apiResource('medicines', MedicineController::class);
        Route::patch('medicines/{medicine}/restore', 
            [MedicineController::class, 'restore']);
        Route::patch('medicines/{medicine}/forcedelete', 
            [MedicineController::class, 'forceDelete']);
            Route::patch('medicines/{medicine}/adjuststock', 
            [MedicineController::class, 'adjustStock']);
    });

}); 