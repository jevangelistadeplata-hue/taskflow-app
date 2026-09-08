<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crear Cuenta - TaskFlow</title>

    <!-- Bootstrap 5.3.3 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-dark">

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-12 col-sm-10 col-md-8 col-lg-5">

                <div class="card shadow-lg border-0">

                    <div class="card-body p-4 p-md-5">

                        <!-- Título -->
                        <div class="text-center mb-4">

                            <h1 class="fw-bold">
                                TaskFlow
                            </h1>

                            <p class="text-muted mb-0">
                                Crear una cuenta
                            </p>

                        </div>

                        <!-- Errores de validación -->
                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <strong>
                                    Por favor, corrige los siguientes errores:
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

                        <!-- Formulario de registro -->
                        <form
                            method="POST"
                            action="{{ route('register.store') }}"
                        >

                            @csrf

                            <!-- Nombre -->
                            <div class="mb-3">

                                <label
                                    for="name"
                                    class="form-label fw-semibold"
                                >
                                    Nombre
                                </label>

                                <input
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    autofocus
                                    autocomplete="name"
                                >

                                @error('name')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                            <!-- Correo electrónico -->
                            <div class="mb-3">

                                <label
                                    for="email"
                                    class="form-label fw-semibold"
                                >
                                    Correo electrónico
                                </label>

                                <input
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                >

                                @error('email')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                            <!-- Contraseña -->
                            <div class="mb-3">

                                <label
                                    for="password"
                                    class="form-label fw-semibold"
                                >
                                    Contraseña
                                </label>

                                <input
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                >

                                @error('password')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                            <!-- Confirmar contraseña -->
                            <div class="mb-4">

                                <label
                                    for="password_confirmation"
                                    class="form-label fw-semibold"
                                >
                                    Confirmar contraseña
                                </label>

                                <input
                                    type="password"
                                    class="form-control"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                >

                            </div>

                            <!-- Botón -->
                            <div class="d-grid">

                                <button
                                    type="submit"
                                    class="btn btn-primary btn-lg"
                                >
                                    Crear cuenta
                                </button>

                            </div>

                        </form>

                        <!-- Regresar al login -->
                        <div class="text-center mt-4">

                            <p class="mb-0">

                                ¿Ya tienes una cuenta?

                                <a href="{{ route('login') }}">
                                    Iniciar sesión
                                </a>

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

</body>
</html>