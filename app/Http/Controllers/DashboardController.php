<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Mostrar el Dashboard del usuario autenticado.
     */
    public function index()
    {
        /** @var User $usuario */
        $usuario = Auth::user();

        // Obtener solamente las tareas del usuario autenticado
        $tareasUsuario = $usuario->tareas();

        // Conteo de tareas activas
        $totalTareas = (clone $tareasUsuario)->count();

        $pendientes = (clone $tareasUsuario)
            ->where('estado', 'pendiente')
            ->count();

        $completadas = (clone $tareasUsuario)
            ->where('estado', 'completada')
            ->count();

        // Conteo de tareas eliminadas lógicamente
        $eliminadas = $usuario->tareas()
            ->onlyTrashed()
            ->count();

        // Últimas 5 tareas del usuario autenticado
        $ultimasTareas = (clone $tareasUsuario)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalTareas',
            'pendientes',
            'completadas',
            'eliminadas',
            'ultimasTareas'
        ));
    }
}