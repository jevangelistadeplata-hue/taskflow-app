<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lista de Tareas - TaskFlow</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        .tarea-completada {
            text-decoration: line-through;
            color: #6c757d;
        }
    </style>

</head>

<body class="bg-dark">

    <div class="container mt-5 mb-5">

        <div class="card shadow">

            <!-- Encabezado -->
            <div class="card-header bg-primary text-white">

                <div class="d-flex justify-content-between align-items-center">

                    <h3 class="mb-0">
                        TaskFlow - Gestión de Tareas
                    </h3>

                    <div>

                        <a href="{{ route('dashboard') }}"
                           class="btn btn-secondary">
                            Dashboard
                        </a>

                        <a href="{{ route('tareas.create') }}"
                           class="btn btn-light">
                            + Nueva Tarea
                        </a>

                    </div>

                </div>

            </div>

            <!-- Contenido -->
            <div class="card-body">

                <!-- Mensaje de éxito -->
                @if(session('success'))

                    <div class="alert alert-success alert-dismissible fade show">

                        {{ session('success') }}

                        <button type="button"
                                class="close"
                                data-dismiss="alert">

                            <span>&times;</span>

                        </button>

                    </div>

                @endif

                <!-- Tabla -->
                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="thead-dark">

                            <tr>

                                <th class="text-center">
                                    ✓
                                </th>

                                <th>
                                    Título
                                </th>

                                <th>
                                    Estado
                                </th>

                                <th>
                                    Fecha Límite
                                </th>

                                <th class="text-center">
                                    Acciones
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($tareas as $tarea)

                                <tr>

                                    <!-- Checkbox -->
                                    <td class="text-center">

                                        <form action="{{ route('tareas.toggle', $tarea->id) }}"
                                              method="POST">

                                            @csrf

                                            @method('PATCH')

                                            <input
                                                type="checkbox"
                                                onchange="this.form.submit()"
                                                {{ $tarea->estado == 'completada' ? 'checked' : '' }}
                                            >

                                        </form>

                                    </td>

                                    <!-- Título -->
                                    <td>

                                        <span class="font-weight-bold
                                            {{ $tarea->estado == 'completada'
                                                ? 'tarea-completada'
                                                : '' }}">

                                            {{ $tarea->titulo }}

                                        </span>

                                    </td>

                                    <!-- Estado -->
                                    <td>

                                        @if($tarea->estado == 'completada')

                                            <span class="badge badge-success">
                                                Completada
                                            </span>

                                        @else

                                            <span class="badge badge-secondary">
                                                Pendiente
                                            </span>

                                        @endif

                                    </td>

                                    <!-- Fecha límite -->
                                    <td>

                                        {{ $tarea->fecha_limite ?? 'Sin fecha' }}

                                    </td>

                                    <!-- Acciones -->
                                    <td class="text-center">

                                        <a href="{{ route('tareas.edit', $tarea->id) }}"
                                           class="btn btn-sm btn-primary">

                                            Editar

                                        </a>

                                        <form
                                            action="{{ route('tareas.destroy', $tarea->id) }}"
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

                            @empty

                                <tr>

                                    <td colspan="5"
                                        class="text-center text-muted">

                                        No hay tareas registradas.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

