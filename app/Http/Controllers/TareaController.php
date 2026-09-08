<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    /**
     * Mostrar las tareas del usuario autenticado.
     */
    public function index(Request $request)
    {
        /** @var User $usuario */
        $usuario = Auth::user();

        $consulta = $usuario->tareas();

        // Búsqueda por título o descripción.
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;

            $consulta->where(function ($query) use ($buscar) {
                $query->where('titulo', 'like', '%' . $buscar . '%')
                    ->orWhere('descripcion', 'like', '%' . $buscar . '%');
            });
        }

        // Filtro por estado.
        if ($request->filled('estado')) {
            $consulta->where('estado', $request->estado);
        }

        // Filtro por categoría.
        if ($request->filled('categoria_id')) {
            $consulta->where('categoria_id', $request->categoria_id);
        }

        // Filtro por prioridad.
        if ($request->filled('prioridad')) {
            $consulta->where('prioridad', $request->prioridad);
        }

        // Obtener tareas con su categoría.
        $tareas = $consulta
            ->with('categoriaRelacion')
            ->latest()
            ->get();

        // Categorías del usuario autenticado.
        $categorias = $usuario
            ->categorias()
            ->orderBy('nombre')
            ->get();

        // Estadísticas del usuario autenticado.
        $tareasUsuario = $usuario->tareas();

        $totalTareas = (clone $tareasUsuario)->count();

        $pendientes = (clone $tareasUsuario)
            ->where('estado', 'pendiente')
            ->count();

        $completadas = (clone $tareasUsuario)
            ->where('estado', 'completada')
            ->count();

        $prioridadBaja = (clone $tareasUsuario)
            ->where('prioridad', 1)
            ->count();

        $prioridadMedia = (clone $tareasUsuario)
            ->where('prioridad', 2)
            ->count();

        $prioridadAlta = (clone $tareasUsuario)
            ->where('prioridad', 3)
            ->count();

        return view('tareas.index', compact(
            'tareas',
            'categorias',
            'totalTareas',
            'pendientes',
            'completadas',
            'prioridadBaja',
            'prioridadMedia',
            'prioridadAlta'
        ));
    }

    /**
     * Mostrar formulario para crear una tarea.
     */
    public function create()
    {
        /** @var User $usuario */
        $usuario = Auth::user();

        $categorias = $usuario
            ->categorias()
            ->orderBy('nombre')
            ->get();

        return view('tareas.create', compact('categorias'));
    }

    /**
     * Guardar una nueva tarea.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'required|date',
            'prioridad' => 'required|integer|in:1,2,3',
            'categoria_id' => 'required|integer|exists:categorias,id',
        ], [
            'titulo.required' => 'El título de la tarea es obligatorio.',
            'titulo.max' => 'El título no puede superar los 255 caracteres.',
            'fecha_limite.required' => 'La fecha límite es obligatoria.',
            'fecha_limite.date' => 'La fecha límite no es válida.',
            'prioridad.required' => 'Debes seleccionar una prioridad.',
            'prioridad.in' => 'La prioridad seleccionada no es válida.',
            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
        ]);

        /** @var User $usuario */
        $usuario = Auth::user();

        // Verificar que la categoría pertenezca al usuario.
        $categoria = $usuario
            ->categorias()
            ->find($request->categoria_id);

        if (!$categoria) {
            abort(403, 'No tienes permiso para utilizar esta categoría.');
        }

        // Crear la tarea utilizando la nueva relación categoria_id.
        $usuario->tareas()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_limite' => $request->fecha_limite,
            'prioridad' => $request->prioridad,
            'categoria_id' => $categoria->id,
            'estado' => 'pendiente',
        ]);

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea creada correctamente.');
    }

    /**
     * Mostrar formulario para editar una tarea.
     */
    public function edit(Tarea $tarea)
    {
        $this->verificarPropietario($tarea);

        /** @var User $usuario */
        $usuario = Auth::user();

        $categorias = $usuario
            ->categorias()
            ->orderBy('nombre')
            ->get();

        return view('tareas.edit', compact(
            'tarea',
            'categorias'
        ));
    }

    /**
     * Actualizar una tarea.
     */
    public function update(Request $request, Tarea $tarea)
    {
        $this->verificarPropietario($tarea);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:pendiente,completada',
            'fecha_limite' => 'required|date',
            'prioridad' => 'required|integer|in:1,2,3',
            'categoria_id' => 'required|integer|exists:categorias,id',
        ], [
            'titulo.required' => 'El título de la tarea es obligatorio.',
            'titulo.max' => 'El título no puede superar los 255 caracteres.',
            'fecha_limite.required' => 'La fecha límite es obligatoria.',
            'fecha_limite.date' => 'La fecha límite no es válida.',
            'prioridad.required' => 'Debes seleccionar una prioridad.',
            'prioridad.in' => 'La prioridad seleccionada no es válida.',
            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
        ]);

        /** @var User $usuario */
        $usuario = Auth::user();

        // Verificar que la categoría pertenezca al usuario.
        $categoria = $usuario
            ->categorias()
            ->find($request->categoria_id);

        if (!$categoria) {
            abort(403, 'No tienes permiso para utilizar esta categoría.');
        }

        // Actualizar la tarea utilizando categoria_id.
        $tarea->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'fecha_limite' => $request->fecha_limite,
            'prioridad' => $request->prioridad,
            'categoria_id' => $categoria->id,
        ]);

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea actualizada correctamente.');
    }

    /**
     * Eliminar una tarea mediante SoftDeletes.
     */
    public function destroy(Tarea $tarea)
    {
        $this->verificarPropietario($tarea);

        $tarea->delete();

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea eliminada correctamente.');
    }

    /**
     * Cambiar una tarea entre pendiente y completada.
     */
    public function toggleStatus(Tarea $tarea)
    {
        $this->verificarPropietario($tarea);

        $tarea->estado = $tarea->estado === 'completada'
            ? 'pendiente'
            : 'completada';

        $tarea->save();

        $mensaje = $tarea->estado === 'completada'
            ? 'Tarea marcada como completada.'
            : 'Tarea marcada como pendiente.';

        return redirect()
            ->route('tareas.index')
            ->with('success', $mensaje);
    }

    /**
     * Verificar que la tarea pertenece al usuario autenticado.
     */
    private function verificarPropietario(Tarea $tarea): void
    {
        if ($tarea->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para acceder a esta tarea.');
        }
    }
}