<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');

    Route::middleware('rol:admin')->group(function () {
        Route::get('/tareas/create', [TaskController::class, 'create'])->name('tareas.create');
        Route::post('/tareas', [TaskController::class, 'store'])->name('tareas.store');
    });

    Route::resource('tareas', TaskController::class)->except(['create', 'store']);
});

require __DIR__.'/auth.php';
