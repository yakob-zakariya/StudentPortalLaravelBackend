<?php

use App\Http\Controllers\Admin\DepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\RegistrarUsersController;
use App\Http\Controllers\Admin\BatchController;


Route::middleware(['auth:sanctum', 'role:ADMIN'])->prefix('admin')->group(function () {

    // Registrar Users
    Route::apiResource('registrars', RegistrarUsersController::class);

    // Departments
    Route::apiresource('departments', DepartmentController::class);

    // Batches
    Route::apiresource('batches', BatchController::class);
});
