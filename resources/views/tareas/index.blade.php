<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mis Tareas - TaskFlow</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>

        body {
            background-color: #121212;
        }

        /* =====================================================
           NAVEGACIÓN
           ===================================================== */

        .navbar-taskflow {
            background-color: #1b1f24;
            border-bottom: 1px solid #343a40;
        }

        .navbar-brand {
            font-size: 1.35rem;
            letter-spacing: 0.5px;
        }

        .nav-link {
            margin-right: 5px;
            border-radius: 6px;
            padding-left: 14px !important;
            padding-right: 14px !important;
        }

        .nav-link:hover {
            background-color: #343a40;
        }

        .nav-link.active {
            background-color: #0d6efd;
            color: #ffffff !important;
        }

        .btn-nueva-tarea {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #ffffff;
            font-weight: 500;
        }

        .btn-nueva-tarea:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
            color: #ffffff;
        }

        .usuario-menu {
            color: #ffffff !important;
            font-weight: 500;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
        }

        /* =====================================================
           CONTENIDO
           ===================================================== */

        .page-header,
        .filter-card,
        .task-card {
            border: none;
            border-radius: 10px;
        }

        .page-header h1 {
            color: #212529;
        }

        /* =====================================================
           FILTROS
           ===================================================== */

        .filter-card .form-control,
        .filter-card .custom-select {
            border-radius: 6px;
        }

        /* =====================================================
           TABLA
           ===================================================== */

        .task-card {
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-top: none;
            vertical-align: middle;
        }

        .table td {
            vertical-align: middle;
        }

        .tarea-completada {
            text-decoration: line-through;
            color: #6c757d;
        }

        .acciones {
            white-space: nowrap;
        }

        /* =====================================================
           ENCABEZADOS DE SECCIÓN
           ===================================================== */

        .seccion-tareas {
            border-radius: 10px 10px 0 0;
        }

        /* =====================================================
           RESPONSIVE
           ===================================================== */

        @media (max-width: 991px) {

            .navbar-nav {
                margin-top: 10px;
            }

            .btn-nueva-tarea {
                display: inline-block;
                margin-top: 5px;
                margin-bottom: 5px;
            }

        }

    </style>

</head>


<body>


    <!-- =========================================================
         BARRA DE NAVEGACIÓN
         ========================================================= -->

    <nav class="navbar navbar-expand-lg navbar-dark navbar-taskflow">

        <div class="container">

            <!-- Nombre de la aplicación -->

            <a class="navbar-brand font-weight-bold"
               href="{{ route('dashboard') }}">

                TaskFlow

            </a>


            <!-- Botón responsive -->

            <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarTaskFlow"
                    aria-controls="navbarTaskFlow"
                    aria-expanded="false"
                    aria-label="Mostrar navegación">

                <span class="navbar-toggler-icon"></span>

            </button>


            <!-- Menú -->

            <div class="collapse navbar-collapse"
                 id="navbarTaskFlow">


                <ul class="navbar-nav mr-auto">


                    <!-- Dashboard -->

                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('dashboard') }}">

                            Dashboard

                        </a>

                    </li>


                    <!-- Tareas -->

                    <li class="nav-item">

                        <a class="nav-link active"
                           href="{{ route('tareas.index') }}">

                            Tareas

                        </a>

                    </li>


                    <!-- Categorías -->

                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('categorias.index') }}">

                            Categorías

                        </a>

                    </li>


                    <!-- Nueva tarea -->

                    <li class="nav-item">

                        <a class="nav-link btn btn-nueva-tarea text-white"
                           href="{{ route('tareas.create') }}">

                            + Nueva tarea

                        </a>

                    </li>


                </ul>


                <!-- Usuario -->

                <ul class="navbar-nav">

                    <li class="nav-item dropdown">


                        <a class="nav-link dropdown-toggle usuario-menu"
                           href="#"
                           id="usuarioMenu"
                           role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false">

                            {{ Auth::user()->name }}

                        </a>


                        <div class="dropdown-menu dropdown-menu-right"
                             aria-labelledby="usuarioMenu">


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


                            <!-- Cerrar sesión -->

                            <form method="POST"
                                  action="{{ route('logout') }}">

                                @csrf

                                <button type="submit"
                                        class="dropdown-item text-danger">

                                    Cerrar sesión

                                </button>

                            </form>


                        </div>

                    </li>

                </ul>


            </div>

        </div>

    </nav>




    <!-- =========================================================
         CONTENIDO PRINCIPAL
         ========================================================= -->

    <div class="container mt-4 mb-5">


        <!-- =====================================================
             ENCABEZADO
             ===================================================== -->

        <div class="card shadow page-header mb-4">

            <div class="card-body">

                <div class="row align-items-center">


                    <div class="col-md-8">

                        <h1 class="h2 font-weight-bold mb-2">

                            Mis tareas

                        </h1>

                        <p class="text-muted mb-0">

                            Administra, busca y organiza tus tareas.

                        </p>

                    </div>


                    <div class="col-md-4 text-md-right mt-3 mt-md-0">

                        <a href="{{ route('tareas.create') }}"
                           class="btn btn-primary">

                            + Nueva tarea

                        </a>

                    </div>


                </div>

            </div>

        </div>




        <!-- =====================================================
             MENSAJE DE ÉXITO
             ===================================================== -->

        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show"
                 role="alert">

                {{ session('success') }}

                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Cerrar">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

        @endif




        <!-- =====================================================
             BÚSQUEDA Y FILTROS
             ===================================================== -->

        <div class="card shadow-sm filter-card mb-4">

            <div class="card-body">


                <h2 class="h5 font-weight-bold mb-3">

                    Buscar y filtrar tareas

                </h2>


                <form method="GET"
                      action="{{ route('tareas.index') }}">


                    <div class="form-row">


                        <!-- Buscar -->

                        <div class="form-group col-md-4">

                            <label for="buscar">

                                Buscar

                            </label>

                            <input type="text"
                                   id="buscar"
                                   name="buscar"
                                   class="form-control"
                                   placeholder="Título o descripción"
                                   value="{{ request('buscar') }}">

                        </div>



                        <!-- Estado -->

                        <div class="form-group col-md-2">

                            <label for="estado">

                                Estado

                            </label>

                            <select name="estado"
                                    id="estado"
                                    class="custom-select">


                                <option value="">

                                    Todos

                                </option>


                                <option value="pendiente"
                                    {{ request('estado') == 'pendiente' ? 'selected' : '' }}>

                                    Pendiente

                                </option>


                                <option value="completada"
                                    {{ request('estado') == 'completada' ? 'selected' : '' }}>

                                    Completada

                                </option>


                            </select>

                        </div>



                        <!-- Categoría -->

                        <div class="form-group col-md-2">

                            <label for="categoria_id">

                                Categoría

                            </label>

                            <select name="categoria_id"
                                    id="categoria_id"
                                    class="custom-select">


                                <option value="">

                                    Todas

                                </option>


                                @foreach($categorias as $categoria)

                                    <option value="{{ $categoria->id }}"
                                        {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>

                                        {{ $categoria->nombre }}

                                    </option>

                                @endforeach


                            </select>

                        </div>



                        <!-- Prioridad -->

                        <div class="form-group col-md-2">

                            <label for="prioridad">

                                Prioridad

                            </label>

                            <select name="prioridad"
                                    id="prioridad"
                                    class="custom-select">


                                <option value="">

                                    Todas

                                </option>


                                <option value="1"
                                    {{ request('prioridad') == '1' ? 'selected' : '' }}>

                                    Baja

                                </option>


                                <option value="2"
                                    {{ request('prioridad') == '2' ? 'selected' : '' }}>

                                    Media

                                </option>


                                <option value="3"
                                    {{ request('prioridad') == '3' ? 'selected' : '' }}>

                                    Alta

                                </option>


                            </select>

                        </div>



                        <!-- Botones -->

                        <div class="form-group col-md-2 d-flex align-items-end">

                            <div class="w-100">


                                <button type="submit"
                                        class="btn btn-primary btn-block">

                                    Buscar

                                </button>


                                <a href="{{ route('tareas.index') }}"
                                   class="btn btn-outline-secondary btn-block">

                                    Limpiar

                                </a>


                            </div>

                        </div>


                    </div>

                </form>


            </div>

        </div>




        <!-- =====================================================
             TAREAS PENDIENTES
             ===================================================== -->

        @php

            $tareasPendientes = $tareas->where('estado', 'pendiente');

            $tareasCompletadas = $tareas->where('estado', 'completada');

        @endphp


        @if($tareasPendientes->count() > 0)


            <div class="card shadow-sm task-card mb-4">


                <div class="card-header bg-warning text-dark seccion-tareas">

                    <div class="d-flex justify-content-between
                                align-items-center">


                        <div>

                            <h2 class="h5 font-weight-bold mb-0">

                                Tareas pendientes

                            </h2>

                            <small>

                                Tareas que todavía están por completar.

                            </small>

                        </div>


                        <span class="badge badge-dark">

                            {{ $tareasPendientes->count() }}

                        </span>


                    </div>

                </div>



                <div class="card-body p-0">


                    <div class="table-responsive">


                        <table class="table table-hover">


                            <thead class="thead-dark">

                                <tr>

                                    <th class="text-center">

                                        ✓

                                    </th>

                                    <th>

                                        Título

                                    </th>

                                    <th>

                                        Categoría

                                    </th>

                                    <th>

                                        Prioridad

                                    </th>

                                    <th>

                                        Estado

                                    </th>

                                    <th>

                                        Fecha límite

                                    </th>

                                    <th class="text-center">

                                        Acciones

                                    </th>

                                </tr>

                            </thead>



                            <tbody>


                                @foreach($tareasPendientes as $tarea)


                                    <tr>


                                        <!-- Checkbox -->

                                        <td class="text-center">

                                            <form action="{{ route('tareas.toggle', $tarea->id) }}"
                                                  method="POST">

                                                @csrf

                                                @method('PATCH')


                                                <input type="checkbox"
                                                       onchange="this.form.submit()">

                                            </form>

                                        </td>



                                        <!-- Título -->

                                        <td>

                                            <span class="font-weight-bold">

                                                {{ $tarea->titulo }}

                                            </span>


                                            @if($tarea->descripcion)

                                                <br>

                                                <small class="text-muted">

                                                    {{ Str::limit($tarea->descripcion, 60) }}

                                                </small>

                                            @endif

                                        </td>



                                        <!-- Categoría -->

                                        <td>

                                            @if($tarea->categoriaRelacion)

                                                <span class="badge badge-primary">

                                                    {{ $tarea->categoriaRelacion->nombre }}

                                                </span>

                                            @else

                                                <span class="badge badge-secondary">

                                                    Sin categoría

                                                </span>

                                            @endif

                                        </td>



                                        <!-- Prioridad -->

                                        <td>

                                            @if($tarea->prioridad == 3)

                                                <span class="badge badge-danger">

                                                    Alta

                                                </span>

                                            @elseif($tarea->prioridad == 2)

                                                <span class="badge badge-warning">

                                                    Media

                                                </span>

                                            @else

                                                <span class="badge badge-success">

                                                    Baja

                                                </span>

                                            @endif

                                        </td>



                                        <!-- Estado -->

                                        <td>

                                            <span class="badge badge-secondary">

                                                Pendiente

                                            </span>

                                        </td>



                                        <!-- Fecha -->

                                        <td>

                                            {{ $tarea->fecha_limite
                                                ? $tarea->fecha_limite->format('d/m/Y')
                                                : 'Sin fecha' }}

                                        </td>



                                        <!-- Acciones -->

                                        <td class="text-center acciones">


                                            <!-- Editar -->

                                            <a href="{{ route('tareas.edit', $tarea->id) }}"
                                               class="btn btn-sm btn-primary">

                                                Editar

                                            </a>



                                            <!-- Eliminar -->

                                            <form action="{{ route('tareas.destroy', $tarea->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?')">

                                                @csrf

                                                @method('DELETE')


                                                <button type="submit"
                                                        class="btn btn-sm btn-danger">

                                                    Eliminar

                                                </button>

                                            </form>


                                        </td>


                                    </tr>


                                @endforeach


                            </tbody>


                        </table>


                    </div>

                </div>

            </div>


        @endif




        <!-- =====================================================
             TAREAS COMPLETADAS
             ===================================================== -->

        @if($tareasCompletadas->count() > 0)


            <div class="card shadow-sm task-card mb-4">


                <div class="card-header bg-success text-white seccion-tareas">

                    <div class="d-flex justify-content-between
                                align-items-center">


                        <div>

                            <h2 class="h5 font-weight-bold mb-0">

                                Tareas completadas

                            </h2>

                            <small>

                                Tareas que ya fueron completadas.

                            </small>

                        </div>


                        <span class="badge badge-light">

                            {{ $tareasCompletadas->count() }}

                        </span>


                    </div>

                </div>



                <div class="card-body p-0">


                    <div class="table-responsive">


                        <table class="table table-hover">


                            <thead class="thead-dark">

                                <tr>

                                    <th class="text-center">

                                        ✓

                                    </th>

                                    <th>

                                        Título

                                    </th>

                                    <th>

                                        Categoría

                                    </th>

                                    <th>

                                        Prioridad

                                    </th>

                                    <th>

                                        Estado

                                    </th>

                                    <th>

                                        Fecha límite

                                    </th>

                                    <th class="text-center">

                                        Acciones

                                    </th>

                                </tr>

                            </thead>



                            <tbody>


                                @foreach($tareasCompletadas as $tarea)


                                    <tr>


                                        <!-- Checkbox -->

                                        <td class="text-center">

                                            <form action="{{ route('tareas.toggle', $tarea->id) }}"
                                                  method="POST">

                                                @csrf

                                                @method('PATCH')


                                                <input type="checkbox"
                                                       onchange="this.form.submit()"
                                                       checked>

                                            </form>

                                        </td>



                                        <!-- Título -->

                                        <td>

                                            <span class="font-weight-bold tarea-completada">

                                                {{ $tarea->titulo }}

                                            </span>


                                            @if($tarea->descripcion)

                                                <br>

                                                <small class="text-muted">

                                                    {{ Str::limit($tarea->descripcion, 60) }}

                                                </small>

                                            @endif

                                        </td>



                                        <!-- Categoría -->

                                        <td>

                                            @if($tarea->categoriaRelacion)

                                                <span class="badge badge-primary">

                                                    {{ $tarea->categoriaRelacion->nombre }}

                                                </span>

                                            @else

                                                <span class="badge badge-secondary">

                                                    Sin categoría

                                                </span>

                                            @endif

                                        </td>



                                        <!-- Prioridad -->

                                        <td>

                                            @if($tarea->prioridad == 3)

                                                <span class="badge badge-danger">

                                                    Alta

                                                </span>

                                            @elseif($tarea->prioridad == 2)

                                                <span class="badge badge-warning">

                                                    Media

                                                </span>

                                            @else

                                                <span class="badge badge-success">

                                                    Baja

                                                </span>

                                            @endif

                                        </td>



                                        <!-- Estado -->

                                        <td>

                                            <span class="badge badge-success">

                                                Completada

                                            </span>

                                        </td>



                                        <!-- Fecha -->

                                        <td>

                                            {{ $tarea->fecha_limite
                                                ? $tarea->fecha_limite->format('d/m/Y')
                                                : 'Sin fecha' }}

                                        </td>



                                        <!-- Acciones -->

                                        <td class="text-center acciones">


                                            <!-- Editar -->

                                            <a href="{{ route('tareas.edit', $tarea->id) }}"
                                               class="btn btn-sm btn-primary">

                                                Editar

                                            </a>



                                            <!-- Eliminar -->

                                            <form action="{{ route('tareas.destroy', $tarea->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?')">

                                                @csrf

                                                @method('DELETE')


                                                <button type="submit"
                                                        class="btn btn-sm btn-danger">

                                                    Eliminar

                                                </button>

                                            </form>


                                        </td>


                                    </tr>


                                @endforeach


                            </tbody>


                        </table>


                    </div>

                </div>

            </div>


        @endif




        <!-- =====================================================
             SIN TAREAS
             ===================================================== -->

        @if($tareasPendientes->count() === 0 && $tareasCompletadas->count() === 0)


            <div class="card shadow-sm task-card">


                <div class="card-body text-center text-muted py-5">


                    <h5>

                        No hay tareas registradas.

                    </h5>


                    <p class="mb-3">

                        No se encontraron tareas
                        con los criterios seleccionados.

                    </p>


                    <a href="{{ route('tareas.create') }}"
                       class="btn btn-primary">

                        + Crear primera tarea

                    </a>


                </div>

            </div>


        @endif


    </div>




    <!-- =========================================================
         BOOTSTRAP JAVASCRIPT
         ========================================================= -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>