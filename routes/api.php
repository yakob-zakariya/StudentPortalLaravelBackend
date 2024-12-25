<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UsersController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Route::get('/test', [LoginController::class, 'login']);


Route::post('/login', [LoginController::class, 'login']);



// Admin Users Functionality routers

Route::prefix('admin')->middleware(['auth:sanctum', 'role:ADMIN'])->group(function () {

    Route::get('registrar_users', [UsersController::class, 'get_registrar_users']);

    Route::post('/registrar_users', [UsersController::class, 'add_registrar_user']);

    Route::get('/users/{id}', [UsersController::class, 'get_user']);

    Route::put('/users/{id}', [UsersController::class, 'update_user']);

    Route::delete('/users/{id}', [UsersController::class, 'delete_user']);
});
