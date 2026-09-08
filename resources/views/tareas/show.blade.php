<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detalle de Tarea - TaskFlow</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }

        .navbar {
            background-color: #1b1f24;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .nav-link {
            color: #ffffff !important;
        }

        .nav-link:hover {
            color: #0d6efd !important;
        }

        .card {
            background-color: #1b1f24;
            border: 1px solid #343a40;
            border-radius: 10px;
        }

        .card-header {
            background-color: #252a30;
            border-bottom: 1px solid #343a40;
        }

        .text-muted {
            color: #adb5bd !important;
        }

        .dato {
            padding: 12px 0;
            border-bottom: 1px solid #343a40;
        }

        .dato:last-child {
            border-bottom: none;
        }

        .titulo-tarea {
            font-size: 28px;
            font-weight: bold;
        }

        .descripcion {
            white-space: pre-line;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark">

        <div class="container">

            <a class="navbar-brand" href="{{ route('dashboard') }}">
                TaskFlow
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarContenido"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContenido">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ route('dashboard') }}"
                        >
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item active">
                        <a
                            class="nav-link"
                            href="{{ route('tareas.index') }}"
                        >
                            Tareas
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ route('categorias.index') }}"
                        >
                            Categorías
                        </a>
                    </li>

                </ul>

                {{-- USUARIO --}}
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">

                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="usuarioMenu"
                            role="button"
                            data-toggle="dropdown"
                        >
                            {{ Auth::user()->name }}
                        </a>

                        <div
                            class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="usuarioMenu"
                        >

                            <div class="dropdown-item-text">
                                <strong>{{ Auth::user()->name }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ Auth::user()->email }}
                                </small>
                            </div>

                            <div class="dropdown-divider"></div>

                            <form
                                method="POST"
                                action="{{ route('logout') }}"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="dropdown-item"
                                >
                                    Cerrar sesión
                                </button>
                            </form>

                        </div>

                    </li>

                </ul>

            </div>

        </div>

    </nav>


    {{-- CONTENIDO --}}
    <div class="container py-5">

        {{-- ENCABEZADO --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="h3 mb-1">
                    Detalle de tarea
                </h1>

                <p class="text-muted mb-0">
                    Información completa de la tarea.
                </p>
            </div>

            <a
                href="{{ route('tareas.index') }}"
                class="btn btn-secondary"
            >
                ← Volver a tareas
            </a>

        </div>


        {{-- TARJETA --}}
        <div class="card shadow">

            <div class="card-header">

                <span class="text-muted">
                    Tarea #{{ $tarea->id }}
                </span>

            </div>

            <div class="card-body">

                {{-- TÍTULO --}}
                <div class="mb-4">

                    <div class="text-muted mb-1">
                        Título
                    </div>

                    <div class="titulo-tarea">
                        {{ $tarea->titulo }}
                    </div>

                </div>


                {{-- DESCRIPCIÓN --}}
                <div class="dato">

                    <div class="text-muted mb-1">
                        Descripción
                    </div>

                    <div class="descripcion">

                        @if($tarea->descripcion)
                            {{ $tarea->descripcion }}
                        @else
                            <span class="text-muted">
                                Sin descripción.
                            </span>
                        @endif

                    </div>

                </div>


                {{-- ESTADO --}}
                <div class="dato">

                    <div class="text-muted mb-1">
                        Estado
                    </div>

                    @if($tarea->estado === 'completada')

                        <span class="badge badge-success">
                            Completada
                        </span>

                    @else

                        <span class="badge badge-warning">
                            Pendiente
                        </span>

                    @endif

                </div>


                {{-- PRIORIDAD --}}
                <div class="dato">

                    <div class="text-muted mb-1">
                        Prioridad
                    </div>

                    @if($tarea->prioridad == 3)

                        <span class="badge badge-danger">
                            Alta
                        </span>

                    @elseif($tarea->prioridad == 2)

                        <span class="badge badge-warning">
                            Media
                        </span>

                    @else

                        <span class="badge badge-secondary">
                            Baja
                        </span>

                    @endif

                </div>


                {{-- CATEGORÍA --}}
                <div class="dato">

                    <div class="text-muted mb-1">
                        Categoría
                    </div>

                    <span class="badge badge-info">
                        {{ $tarea->categoria }}
                    </span>

                </div>


                {{-- FECHA LÍMITE --}}
                <div class="dato">

                    <div class="text-muted mb-1">
                        Fecha límite
                    </div>

                    @if($tarea->fecha_limite)

                        {{ $tarea->fecha_limite->format('d/m/Y') }}

                    @else

                        <span class="text-muted">
                            Sin fecha límite.
                        </span>

                    @endif

                </div>


                {{-- FECHA DE CREACIÓN --}}
                <div class="dato">

                    <div class="text-muted mb-1">
                        Creada el
                    </div>

                    {{ $tarea->created_at->format('d/m/Y H:i') }}

                </div>


                {{-- ÚLTIMA ACTUALIZACIÓN --}}
                <div class="dato">

                    <div class="text-muted mb-1">
                        Última actualización
                    </div>

                    {{ $tarea->updated_at->format('d/m/Y H:i') }}

                </div>


                {{-- BOTONES --}}
                <div class="mt-4">

                    <a
                        href="{{ route('tareas.edit', $tarea) }}"
                        class="btn btn-primary"
                    >
                        Editar tarea
                    </a>

                    <a
                        href="{{ route('tareas.index') }}"
                        class="btn btn-secondary"
                    >
                        Volver
                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- JAVASCRIPT BOOTSTRAP --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>