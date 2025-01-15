<?php

use App\Http\Controllers\Admin\DepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegistrarUsersController;
use App\Http\Controllers\Admin\DepartmentCoordinatorUsersController;


Route::middleware(['auth:sanctum', 'role:ADMIN'])->prefix('admin')->group(function () {

    // Registrar Users
    // Route::apiResource('registrars', RegistrarUsersController::class);
    Route::apiResource('registrars', RegistrarUsersController::class)
        ->parameters(['registrars' => 'user']);

    // DepartmentCoordinator Users
    // Route::apiResource('department-coordinators', DepartmentCoordinatorUsersController::class);
    Route::apiResource('department-coordinators', DepartmentCoordinatorUsersController::class)
        ->parameters(['department-coordinators' => 'user']);

    // Departments
    Route::apiresource('departments', DepartmentController::class);
});
