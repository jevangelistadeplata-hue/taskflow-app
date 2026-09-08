<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Categoría - TaskFlow</title>

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

        .form-control {
            background-color: #252a30;
            color: #ffffff;
            border: 1px solid #495057;
        }

        .form-control:focus {
            background-color: #252a30;
            color: #ffffff;
            border-color: #0d6efd;
            box-shadow: none;
        }

        .text-muted {
            color: #adb5bd !important;
        }

        .dropdown-menu {
            background-color: #ffffff;
        }

    </style>

</head>

<body>

    <!-- Barra de navegación -->

    <nav class="navbar navbar-expand-lg navbar-dark">

        <div class="container">

            <a
                class="navbar-brand"
                href="{{ route('dashboard') }}"
            >
                TaskFlow
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarContenido"
                aria-controls="navbarContenido"
                aria-expanded="false"
                aria-label="Mostrar navegación"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse"
                id="navbarContenido"
            >

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="{{ route('dashboard') }}"
                        >
                            Dashboard
                        </a>

                    </li>

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="{{ route('tareas.index') }}"
                        >
                            Tareas
                        </a>

                    </li>

                    <li class="nav-item active">

                        <a
                            class="nav-link"
                            href="{{ route('categorias.index') }}"
                        >
                            Categorías
                        </a>

                    </li>

                </ul>


                <!-- Usuario -->

                <ul class="navbar-nav">

                    <li class="nav-item dropdown">

                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="usuarioMenu"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            {{ Auth::user()->name }}
                        </a>

                        <div
                            class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="usuarioMenu"
                        >

                            <div class="dropdown-item-text">

                                <strong>
                                    {{ Auth::user()->name }}
                                </strong>

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


    <!-- Contenido -->

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-6">

                <!-- Encabezado -->

                <div class="mb-4">

                    <h1 class="h3">
                        Editar categoría
                    </h1>

                    <p class="text-muted mb-0">
                        Modifica el nombre de tu categoría.
                    </p>

                </div>


                <!-- Mensajes de error -->

                @if ($errors->any())

                    <div class="alert alert-danger">

                        <strong>
                            Se encontraron los siguientes errores:
                        </strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <!-- Formulario -->

                <div class="card shadow">

                    <div class="card-header">

                        <strong>
                            Información de la categoría
                        </strong>

                    </div>

                    <div class="card-body">

                        <form
                            method="POST"
                            action="{{ route('categorias.update', $categoria) }}"
                        >

                            @csrf

                            @method('PUT')


                            <!-- Nombre -->

                            <div class="form-group">

                                <label for="nombre">
                                    Nombre de la categoría
                                </label>

                                <input
                                    type="text"
                                    id="nombre"
                                    name="nombre"
                                    class="form-control @error('nombre') is-invalid @enderror"
                                    value="{{ old('nombre', $categoria->nombre) }}"
                                    maxlength="100"
                                    required
                                    autofocus
                                >

                                @error('nombre')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <!-- Botones -->

                            <div class="d-flex justify-content-between mt-4">

                                <a
                                    href="{{ route('categorias.index') }}"
                                    class="btn btn-secondary"
                                >
                                    Cancelar
                                </a>

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    Guardar cambios
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- JavaScript de Bootstrap -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>