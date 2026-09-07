<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Tarea - TaskFlow</title>

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
                            Editar Tarea
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

                        <form action="{{ route('tareas.update', $tarea) }}"
                              method="POST">

                            @csrf

                            @method('PUT')

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
                                    value="{{ old('titulo', $tarea->titulo) }}"
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
                                >{{ old('descripcion', $tarea->descripcion) }}</textarea>

                            </div>

                            <!-- Estado -->
                            <div class="form-group">

                                <label for="estado">
                                    Estado
                                </label>

                                <select
                                    name="estado"
                                    id="estado"
                                    class="form-control"
                                    required
                                >

                                    <option value="pendiente"
                                        {{ old('estado', $tarea->estado) == 'pendiente' ? 'selected' : '' }}>
                                        Pendiente
                                    </option>

                                    <option value="completada"
                                        {{ old('estado', $tarea->estado) == 'completada' ? 'selected' : '' }}>
                                        Completada
                                    </option>

                                </select>

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
                                    value="{{ old('fecha_limite', $tarea->fecha_limite) }}"
                                >

                            </div>

                            <!-- Botones -->
                            <button type="submit"
                                    class="btn btn-success">

                                Actualizar Tarea

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

