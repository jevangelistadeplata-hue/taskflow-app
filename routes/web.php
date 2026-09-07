<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Rutas principales
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Rutas protegidas por autenticación
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Rutas de tareas
    |--------------------------------------------------------------------------
    */

    // Cambiar rápidamente el estado de una tarea
    Route::patch('/tareas/{tarea}/toggle', [TareaController::class, 'toggleStatus'])
        ->name('tareas.toggle');

    // CRUD completo de tareas
    Route::resource('/tareas', TareaController::class);
});