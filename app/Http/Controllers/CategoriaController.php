<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    /**
     * Mostrar todas las categorías
     * del usuario autenticado.
     */
    public function index()
    {
        /** @var User $usuario */
        $usuario = Auth::user();

        $categorias = $usuario
            ->categorias()
            ->orderBy('nombre')
            ->get();

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Mostrar el formulario para crear
     * una nueva categoría.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Guardar una nueva categoría.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.max' => 'El nombre de la categoría no puede superar los 100 caracteres.',
        ]);

        $nombre = trim($request->nombre);

        /** @var User $usuario */
        $usuario = Auth::user();

        $existe = $usuario
            ->categorias()
            ->whereRaw('LOWER(nombre) = ?', [strtolower($nombre)])
            ->exists();

        if ($existe) {
            return back()
                ->withInput()
                ->withErrors([
                    'nombre' => 'Ya tienes una categoría con ese nombre.',
                ]);
        }

        $usuario->categorias()->create([
            'nombre' => $nombre,
        ]);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    /**
     * Mostrar el formulario para editar
     * una categoría.
     */
    public function edit(Categoria $categoria)
    {
        $this->verificarPropietario($categoria);

        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Actualizar una categoría.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $this->verificarPropietario($categoria);

        $request->validate([
            'nombre' => 'required|string|max:100',
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.max' => 'El nombre de la categoría no puede superar los 100 caracteres.',
        ]);

        $nombre = trim($request->nombre);

        /** @var User $usuario */
        $usuario = Auth::user();

        $existe = $usuario
            ->categorias()
            ->whereRaw('LOWER(nombre) = ?', [strtolower($nombre)])
            ->where('id', '!=', $categoria->id)
            ->exists();

        if ($existe) {
            return back()
                ->withInput()
                ->withErrors([
                    'nombre' => 'Ya tienes una categoría con ese nombre.',
                ]);
        }

        $categoria->update([
            'nombre' => $nombre,
        ]);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Eliminar una categoría.
     */
    public function destroy(Categoria $categoria)
    {
        $this->verificarPropietario($categoria);

        $categoria->delete();

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }

    /**
     * Verificar que la categoría pertenezca
     * al usuario autenticado.
     */
    private function verificarPropietario(Categoria $categoria): void
    {
        if ($categoria->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para acceder a esta categoría.');
        }
    }
}