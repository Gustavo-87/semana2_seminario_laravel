<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalTareas = Task::count();
    $tareasPendientes = Task::where('estado', 'pendiente')->count();
    $tareasEnProgreso = Task::where('estado', 'en_progreso')->count();
    $tareasCompletadas = Task::where('estado', 'completada')->count();

    return view('dashboard', compact(
        'totalTareas',
        'tareasPendientes',
        'tareasEnProgreso',
        'tareasCompletadas'
    ));
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
