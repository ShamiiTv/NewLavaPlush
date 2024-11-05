<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="icon" href="{{ asset('imagenes/logo/logo2lavaplus.png') }}" type="icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="contenedor">
        <div class="contenedorBienvenida">
            <h5>¡Registro de Usuario!</h5>
        </div>
        <div class="lineaSeparadora"></div>

        <div class="contenedorformulario">
            <form action="{{ route('registro') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="text" class="form-control" name="name" placeholder="Nombre completo" required>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-4">
                    <input type="email" class="form-control" name="email" placeholder="Ingrese su correo electrónico institucional" required>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-4">
                    <input type="password" class="form-control" name="password" placeholder="Ingrese su contraseña" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-4">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirme su contraseña" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <div class="contenedorBoton">
                    <button type="submit" class="btn1">Registrar</button>
                    <button type="button" class="btn2" onclick="window.location.href='{{ route('login') }}'">Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
