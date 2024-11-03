<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="contenedor">
        <div class="contenedorimagen">
            <img src="{{ asset('imagenes/LogoHSJ.png') }}" alt="Logo">
        </div>
        <div class="contenedorBienvenida">
            <h5>Recuperar Contraseña</h5>
        </div>
        <div class="lineaSeparadora"></div>

        <div class="contenedorformulario">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @error('email')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="email" class="form-control" name="email" placeholder="Ingrese su correo electrónico" required>
                </div>
                <div class="contenedorBoton">
                    <button type="submit" class="btn1">Enviar Enlace de Restablecimiento</button>
                    <button type="button" class="btn2" onclick="window.location.href='{{ route('login') }}'">Iniciar Sesión</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>
