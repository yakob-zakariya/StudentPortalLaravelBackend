<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




// Auth routes
require __DIR__ . '/auth.php';

// Admin Users routes

require __DIR__ . '/admin.php';

// Registrar Users routes
require __DIR__ . '/registrar.php';

// Department Coordinator routes
require __DIR__ . '/DepartmentCoordinator.php';

// Student routes
require __DIR__ . '/student.php';
