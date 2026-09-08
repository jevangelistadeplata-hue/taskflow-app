<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Categorías - TaskFlow</title>

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

        .page-header {
            background-color: #ffffff;
            color: #212529;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
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

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-top: none;
        }

        .badge-categoria {
            background-color: #0d6efd;
            color: #ffffff;
            font-size: 14px;
            padding: 7px 12px;
            border-radius: 20px;
        }

        .btn-nueva {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #ffffff;
        }

        .btn-nueva:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
            color: #ffffff;
        }

        .empty-state {
            padding: 50px 20px;
            text-align: center;
            color: #6c757d;
        }

        .empty-state h5 {
            color: #343a40;
        }

    </style>

</head>

<body>

    <!-- Barra de navegación -->

    <nav class="navbar navbar-expand-lg navbar-dark">

        <div class="container">

            <a class="navbar-brand" href="{{ route('dashboard') }}">
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

            <div class="collapse navbar-collapse" id="navbarPrincipal">

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


    <!-- Contenido principal -->

    <div class="container mt-4 mb-5">

        <!-- Encabezado -->

        <div class="page-header">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h2 class="mb-1">
                        Categorías
                    </h2>

                    <p class="text-muted mb-0">
                        Administra las categorías que utilizas para organizar tus tareas.
                    </p>

                </div>

                <div class="mt-3 mt-md-0">

                    <a
                        href="{{ route('categorias.create') }}"
                        class="btn btn-nueva"
                    >
                        + Nueva categoría
                    </a>

                </div>

            </div>

        </div>


        <!-- Mensaje de éxito -->

        @if(session('success'))

            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >

                {{ session('success') }}

                <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Cerrar"
                >

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

        @endif


        <!-- Lista de categorías -->

        <div class="card shadow">

            <div class="card-header">
                Mis categorías
            </div>

            @if($categorias->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead class="thead-light">

                            <tr>

                                <th width="80">
                                    #
                                </th>

                                <th>
                                    Categoría
                                </th>

                                <th width="180">
                                    Fecha de creación
                                </th>

                                <th width="180">
                                    Acciones
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($categorias as $categoria)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>

                                        <span class="badge-categoria">
                                            {{ $categoria->nombre }}
                                        </span>

                                    </td>

                                    <td>
                                        {{ $categoria->created_at->format('d/m/Y') }}
                                    </td>

                                    <td>

                                        <a
                                            href="{{ route('categorias.edit', $categoria) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('categorias.destroy', $categoria) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                            >
                                                Eliminar
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <h5>
                        No tienes categorías todavía.
                    </h5>

                    <p class="mb-3">
                        Crea tu primera categoría para comenzar a organizar tus tareas.
                    </p>

                    <a
                        href="{{ route('categorias.create') }}"
                        class="btn btn-primary"
                    >
                        Crear primera categoría
                    </a>

                </div>

            @endif

        </div>

    </div>


    <!-- Bootstrap JavaScript -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>