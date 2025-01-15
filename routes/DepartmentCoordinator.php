<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentCoordinator\CourseController;
use App\Http\Controllers\DepartmentCoordinator\DepartmentBatches;
use App\Http\Controllers\DepartmentCoordinator\SectionController;
use App\Http\Controllers\DepartmentCoordinator\CourseAllocationController;

Route::prefix('department-coordinator')->middleware(['auth:sanctum', 'role:COORDINATOR'])->group(function () {

    Route::apiResource('courses', CourseController::class);

    Route::get('batches', [DepartmentBatches::class, 'index']);
    Route::get('batches/{batch}', [DepartmentBatches::class, 'show']);


    Route::prefix('batches/{batch}')->group(function () {
        Route::apiResource('sections', SectionController::class);
    });




    Route::prefix('batches/{batch}/semesters/{semester}/')->group(function () {
        Route::apiResource('course-allocations', CourseAllocationController::class)->only(['index', 'store']);
    });


    Route::delete('course-allocations/{allocation}', [CourseAllocationController::class, 'destroy']);
});
