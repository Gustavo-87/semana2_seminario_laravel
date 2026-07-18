<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register'])->name('api.register');
Route::post('login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me'])->name('api.me');
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::apiResource('tareas', TaskController::class)->names('api.tareas');
});
