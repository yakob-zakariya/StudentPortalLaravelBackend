<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


Route::prefix('auth')->middleware('guest')->group(function () {

    Route::post('/login', [LoginController::class, 'login']);
});
