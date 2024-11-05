<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('imagenes/logo/logo2lavaplus.png') }}" type="icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="contenedor">
        <div class="contenedorimagen">
        </div>
        <div class="contenedorBienvenida">
            <h5>¡Bienvenido, usuario!</h5>
        </div>
        <div class="lineaSeparadora"></div>

        <div class="contenedorformulario">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" 
                           name="email" aria-describedby="emailHelp" placeholder="Ingrese su correo electrónico institucional" required
                           value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" 
                           name="password" placeholder="Ingrese su contraseña" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="contenedorBoton">
                    <button type="submit" class="btn1">Iniciar Sesión</button>
                    <button type="button" class="btn2" onclick="window.location.href='{{ route('registro') }}'">Crear Cuenta</button>
                </div>
                <div class="recuperarContraseña">
                    <a class="recuperarContraseña" href="{{ route('password.request') }}">Recuperar contraseña</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Error -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error de Autenticación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
