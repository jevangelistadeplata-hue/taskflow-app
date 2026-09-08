<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nueva Categoría - TaskFlow</title>

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

        .form-container {
            max-width: 650px;
            margin: 40px auto;
        }

        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            background-color: #ffffff;
            color: #212529;
            font-weight: bold;
        }

        .card-body {
            background-color: #ffffff;
            color: #212529;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
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
                data-target="#navbarPrincipal"
                aria-controls="navbarPrincipal"
                aria-expanded="false"
                aria-label="Mostrar navegación"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse"
                id="navbarPrincipal"
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
                                action="{{ route('logout') }}"
                                method="POST"
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

    <div class="container">

        <div class="form-container">

            <div class="card shadow">

                <div class="card-header">

                    <h4 class="mb-0">
                        Nueva categoría
                    </h4>

                </div>

                <div class="card-body">

                    <p class="text-muted">
                        Crea una categoría para organizar tus tareas.
                    </p>


                    <!-- Errores de validación -->

                    @if($errors->any())

                        <div class="alert alert-danger">

                            <strong>
                                Revisa los siguientes errores:
                            </strong>

                            <ul class="mb-0 mt-2">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <form
                        action="{{ route('categorias.store') }}"
                        method="POST"
                    >

                        @csrf

                        <div class="form-group">

                            <label for="nombre">
                                Nombre de la categoría
                            </label>

                            <input
                                type="text"
                                name="nombre"
                                id="nombre"
                                class="form-control @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre') }}"
                                maxlength="100"
                                placeholder="Ejemplo: Trabajo"
                                autofocus
                                required
                            >

                            @error('nombre')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <div class="d-flex justify-content-between">

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
                                Guardar categoría
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <!-- Bootstrap JavaScript -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>