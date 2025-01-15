<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registrar\BatchController;
use App\Http\Controllers\Registrar\AcademicYearConroller;
use App\Http\Controllers\Registrar\SemesterController;
use App\Http\Controllers\Registrar\StudentController;


Route::prefix('registrars')->middleware(['auth:sanctum', 'role:REGISTRAR',])->group(function () {
    // Batches
    Route::apiresource('batches', BatchController::class);

    Route::apiResource('academic-years', AcademicYearConroller::class);

    Route::prefix('academic-years/{academicYear}')->group(function () {
        Route::apiResource('semesters', SemesterController::class);
    });

    Route::apiResource('students', StudentController::class);
});
