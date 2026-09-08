<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Página de entrada
|--------------------------------------------------------------------------
|
| La página "/" será controlada por HomeController.
|
| Usuario NO autenticado → Login
| Usuario autenticado → Dashboard
|
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| Rutas protegidas
|--------------------------------------------------------------------------
|
| Estas rutas solamente pueden ser utilizadas
| por usuarios autenticados.
|
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Cambiar estado de una tarea
    |--------------------------------------------------------------------------
    */

    Route::patch('/tareas/{tarea}/toggle', [TareaController::class, 'toggleStatus'])
        ->name('tareas.toggle');


    /*
    |--------------------------------------------------------------------------
    | Gestión de tareas
    |--------------------------------------------------------------------------
    |
    | Se excluye "show" porque TareaController no tiene
    | un método show().
    |
    */

    Route::resource('/tareas', TareaController::class)
        ->except(['show']);
});