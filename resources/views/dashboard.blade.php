<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - TaskFlow</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>

<body class="bg-dark">

    <div class="container mt-5 mb-5">

        <!-- Encabezado -->
        <div class="card shadow mb-4">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h1 class="h2 font-weight-bold mb-1">
                            TaskFlow Dashboard
                        </h1>

                        <p class="text-muted mb-0">
                            Resumen general y métricas del sistema
                        </p>

                    </div>

                    <a href="{{ route('tareas.index') }}"
                       class="btn btn-primary">

                        Ir a Lista de Tareas →

                    </a>

                </div>

            </div>

        </div>


        <!-- Tarjetas de estadísticas -->
        <div class="row mb-4">

            <!-- Total de tareas -->
            <div class="col-md-6 col-lg-3 mb-3">

                <div class="card shadow border-left-primary h-100">

                    <div class="card-body">

                        <p class="text-muted mb-1">
                            Total Tareas
                        </p>

                        <h2 class="font-weight-bold mb-0">
                            {{ $totalTareas }}
                        </h2>

                    </div>

                </div>

            </div>


            <!-- Pendientes -->
            <div class="col-md-6 col-lg-3 mb-3">

                <div class="card shadow border-left-warning h-100">

                    <div class="card-body">

                        <p class="text-muted mb-1">
                            Pendientes
                        </p>

                        <h2 class="font-weight-bold text-warning mb-0">
                            {{ $pendientes }}
                        </h2>

                    </div>

                </div>

            </div>


            <!-- Completadas -->
            <div class="col-md-6 col-lg-3 mb-3">

                <div class="card shadow border-left-success h-100">

                    <div class="card-body">

                        <p class="text-muted mb-1">
                            Completadas
                        </p>

                        <h2 class="font-weight-bold text-success mb-0">
                            {{ $completadas }}
                        </h2>

                    </div>

                </div>

            </div>


            <!-- Eliminadas -->
            <div class="col-md-6 col-lg-3 mb-3">

                <div class="card shadow border-left-danger h-100">

                    <div class="card-body">

                        <p class="text-muted mb-1">
                            Archivadas (Auditoría)
                        </p>

                        <h2 class="font-weight-bold text-danger mb-0">
                            {{ $eliminadas }}
                        </h2>

                    </div>

                </div>

            </div>

        </div>


        <!-- Últimas tareas -->
        <div class="card shadow">

            <div class="card-body">

                <h2 class="h5 font-weight-bold mb-4">
                    Últimas Tareas Registradas
                </h2>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover mb-0">

                        <thead class="thead-dark">

                            <tr>

                                <th>
                                    Título
                                </th>

                                <th>
                                    Estado
                                </th>

                                <th>
                                    Fecha Límite
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($ultimasTareas as $tarea)

                                <tr>

                                    <td class="font-weight-bold">

                                        {{ $tarea->titulo }}

                                    </td>

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

                                    <td>

                                        {{ $tarea->fecha_limite ?? 'Sin fecha' }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3"
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

</body>

</html>

