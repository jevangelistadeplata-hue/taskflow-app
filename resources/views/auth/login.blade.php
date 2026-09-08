<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar Sesión - TaskFlow</title>

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
                            <h1 class="fw-bold">TaskFlow</h1>
                            <p class="text-muted mb-0">
                                Iniciar sesión
                            </p>
                        </div>

                        <!-- Mensajes de sesión -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Errores de validación -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Por favor, corrige los siguientes errores:</strong>

                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Formulario de inicio de sesión -->
                        <form method="POST" action="{{ route('login.store') }}">
                            @csrf

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
                                    autofocus
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
                                    autocomplete="current-password"
                                >

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Recordarme -->
                            <div class="form-check mb-4">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                    id="remember"
                                    value="1"
                                >

                                <label
                                    class="form-check-label"
                                    for="remember"
                                >
                                    Recordarme
                                </label>
                            </div>

                            <!-- Botón -->
                            <div class="d-grid">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-lg"
                                >
                                    Iniciar sesión
                                </button>
                            </div>
                        </form>

                        <!-- Registro -->
                        <div class="text-center mt-4">
                            <p class="mb-0">
                                ¿No tienes una cuenta?
                                <a href="{{ route('register') }}">
                                    Crear una cuenta
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