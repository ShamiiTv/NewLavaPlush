<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="contenedor">
        <div class="contenedorimagen">
           <!-- <img src="{{ asset('imagenes/LogoHSJ.png') }}"> -->
        </div>
        <div class="contenedorBienvenida">
            <h5>¡Bienvenido, usuario!</h5>
        </div>
        <div class="lineaSeparadora"></div>

        <div class="contenedorformulario">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                        aria-describedby="emailHelp" placeholder="Ingrese su correo electrónico institucional" required>
                </div>
                <div class="mb-4">
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                        placeholder="Ingrese su contraseña" required>
                </div>
                <div class="contenedorBoton">
                    <button type="submit" class="btn1">Iniciar Sesión</button>
                    <button type="button" class="btn2"
                        onclick="window.location.href='{{ route('registro') }}'">Crear Cuenta</button>
                </div>
                <div class="recuperarContraseña">
                    <a class="recuperarContraseña"href="{{ route('password.request') }}">Recuperar contraseña</a>
                    
                </div>
            </form>
        </div>
    </div>
</body>

</html>