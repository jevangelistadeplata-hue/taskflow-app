<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Página de entrada de la aplicación.
     *
     * Si el usuario está autenticado:
     * → Dashboard
     *
     * Si no está autenticado:
     * → Login
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login');
    }
}