<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\CourseRegistrationController;

Route::prefix('student')->middleware(['auth:sanctum', 'role:STUDENT'])->group(function () {

    Route::apiResource('course-registrations/semesters/{semester}', CourseRegistrationController::class)->only(['index', 'store']);
});
