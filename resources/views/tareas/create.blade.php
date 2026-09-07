<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crear Tarea - TaskFlow</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>

<body class="bg-dark">

    <div class="container mt-5 mb-5">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card shadow">

                    <!-- Encabezado -->
                    <div class="card-header bg-primary text-white">

                        <h4 class="mb-0">
                            Nueva Tarea
                        </h4>

                    </div>

                    <!-- Contenido -->
                    <div class="card-body">

                        <!-- Errores de validación -->
                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <ul class="mb-0">

                                    @foreach ($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif

                        <form action="{{ route('tareas.store') }}"
                              method="POST">

                            @csrf

                            <!-- Título -->
                            <div class="form-group">

                                <label for="titulo">
                                    Título
                                </label>

                                <input
                                    type="text"
                                    name="titulo"
                                    id="titulo"
                                    class="form-control"
                                    value="{{ old('titulo') }}"
                                    placeholder="Escriba el título de la tarea"
                                    required
                                >

                            </div>

                            <!-- Descripción -->
                            <div class="form-group">

                                <label for="descripcion">
                                    Descripción
                                </label>

                                <textarea
                                    name="descripcion"
                                    id="descripcion"
                                    class="form-control"
                                    rows="5"
                                    placeholder="Escriba la descripción de la tarea"
                                >{{ old('descripcion') }}</textarea>

                            </div>

                            <!-- Fecha límite -->
                            <div class="form-group">

                                <label for="fecha_limite">
                                    Fecha Límite
                                </label>

                                <input
                                    type="date"
                                    name="fecha_limite"
                                    id="fecha_limite"
                                    class="form-control"
                                    value="{{ old('fecha_limite') }}"
                                >

                            </div>

                            <!-- Botones -->
                            <button type="submit"
                                    class="btn btn-success">

                                Guardar Tarea

                            </button>

                            <a href="{{ route('tareas.index') }}"
                               class="btn btn-secondary">

                                Cancelar

                            </a>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>

