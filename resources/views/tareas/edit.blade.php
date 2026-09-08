<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Editar Tarea - TaskFlow</title>

    <!-- Bootstrap 4 -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    >

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

                                <strong>
                                    Revisa los siguientes errores:
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
                        <form
                            action="{{ route('tareas.update', $tarea) }}"
                            method="POST"
                        >

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
                                    class="form-control @error('titulo') is-invalid @enderror"
                                    value="{{ old('titulo', $tarea->titulo) }}"
                                    maxlength="255"
                                    required
                                >

                                @error('titulo')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <!-- Descripción -->
                            <div class="form-group">

                                <label for="descripcion">
                                    Descripción
                                </label>

                                <textarea
                                    name="descripcion"
                                    id="descripcion"
                                    class="form-control @error('descripcion') is-invalid @enderror"
                                    rows="5"
                                >{{ old('descripcion', $tarea->descripcion) }}</textarea>

                                @error('descripcion')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <div class="row">


                                <!-- Estado -->
                                <div class="form-group col-md-4">

                                    <label for="estado">
                                        Estado
                                    </label>

                                    <select
                                        name="estado"
                                        id="estado"
                                        class="form-control @error('estado') is-invalid @enderror"
                                        required
                                    >

                                        <option
                                            value="pendiente"
                                            {{ old('estado', $tarea->estado) == 'pendiente' ? 'selected' : '' }}
                                        >
                                            Pendiente
                                        </option>

                                        <option
                                            value="completada"
                                            {{ old('estado', $tarea->estado) == 'completada' ? 'selected' : '' }}
                                        >
                                            Completada
                                        </option>

                                    </select>

                                    @error('estado')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                <!-- Fecha límite -->
                                <div class="form-group col-md-4">

                                    <label for="fecha_limite">
                                        Fecha Límite
                                    </label>

                                    <input
                                        type="date"
                                        name="fecha_limite"
                                        id="fecha_limite"
                                        class="form-control @error('fecha_limite') is-invalid @enderror"
                                        value="{{ old('fecha_limite', $tarea->fecha_limite?->format('Y-m-d')) }}"
                                        required
                                    >

                                    @error('fecha_limite')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                <!-- Prioridad -->
                                <div class="form-group col-md-4">

                                    <label for="prioridad">
                                        Prioridad
                                    </label>

                                    <select
                                        name="prioridad"
                                        id="prioridad"
                                        class="form-control @error('prioridad') is-invalid @enderror"
                                        required
                                    >

                                        <option
                                            value="1"
                                            {{ old('prioridad', $tarea->prioridad) == '1' ? 'selected' : '' }}
                                        >
                                            Baja
                                        </option>

                                        <option
                                            value="2"
                                            {{ old('prioridad', $tarea->prioridad) == '2' ? 'selected' : '' }}
                                        >
                                            Media
                                        </option>

                                        <option
                                            value="3"
                                            {{ old('prioridad', $tarea->prioridad) == '3' ? 'selected' : '' }}
                                        >
                                            Alta
                                        </option>

                                    </select>

                                    @error('prioridad')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>

                            </div>


                            <!-- =====================================================
                                 CATEGORÍA
                                 ===================================================== -->

                            <div class="form-group">

                                <label for="categoria_id">
                                    Categoría
                                </label>

                                <select
                                    name="categoria_id"
                                    id="categoria_id"
                                    class="form-control @error('categoria_id') is-invalid @enderror"
                                    required
                                >

                                    <option value="">
                                        Seleccione
                                    </option>


                                    @forelse ($categorias as $categoria)

                                        <option
                                            value="{{ $categoria->id }}"
                                            {{ old('categoria_id', $tarea->categoria_id) == $categoria->id ? 'selected' : '' }}
                                        >
                                            {{ $categoria->nombre }}
                                        </option>

                                    @empty

                                        <option value="" disabled>
                                            No tienes categorías creadas
                                        </option>

                                    @endforelse

                                </select>


                                @error('categoria_id')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror


                                @if ($categorias->isEmpty())

                                    <small class="form-text text-muted">

                                        Primero debes crear una categoría.

                                    </small>

                                @endif

                            </div>


                            <!-- =====================================================
                                 BOTONES
                                 ===================================================== -->

                            <button
                                type="submit"
                                class="btn btn-success"
                                {{ $categorias->isEmpty() ? 'disabled' : '' }}
                            >
                                Actualizar Tarea
                            </button>


                            <a
                                href="{{ route('tareas.index') }}"
                                class="btn btn-secondary"
                            >
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