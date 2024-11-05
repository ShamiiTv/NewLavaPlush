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
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="contenedor">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="contenedorBienvenida">
            <h5>¡Registro de Usuario!</h5>
        </div>
        <div class="lineaSeparadora"></div>

        <div class="contenedorformulario">
            <form action="{{ route('registro') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
                           value="{{ old('name') }}" placeholder="Nombre completo" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                           value="{{ old('email') }}" placeholder="Ingrese su correo electrónico institucional" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" 
                           placeholder="Ingrese su contraseña" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                           name="password_confirmation" placeholder="Confirme su contraseña" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
