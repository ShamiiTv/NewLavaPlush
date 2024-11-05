<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
  <link rel="icon" href="{{ asset('imagenes/logo/logo2lavaplus.png') }}" type="icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('inicio') }}">LavaPlus</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" aria-disabled="true">¡Bienvenido, {{ Auth::user()->name }}!</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="d-flex">
    <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="min-width: 350px; max-width: 350px;">
      <a class="nav-link" aria-disabled="true">
        <span class="icon-container">
          <img src="{{ asset('imagenes/iconos/usuario.png') }}" style="margin: 3px" alt="Usuario" width="20"
            height="20">
        </span>
        <span>{{ Auth::user()->name }}</span>
      </a>


      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="{{ route('inicio') }}" class="nav-link text-white">
            <img src="{{ asset('imagenes/iconos/home.png') }}" class="bi pe-none me-2" width="22" height="22"
              alt="Inicio Icon">
            Inicio
          </a>
        </li>
        <li>
          <a href="{{ route('ingresoInterno') }}" class="nav-link text-white">
            <img src="{{ asset('imagenes/iconos/add-circle.png') }}" class="bi pe-none me-2" width="22" height="22"
              alt="Ingreso Icon">
            Ingreso de ropa Servicio Clínico
          </a>
        </li>
        <li>
          <a href="{{ route('egresoInterno') }}" class="nav-link text-white">
            <img src="{{ asset('imagenes/iconos/remove-circle.png') }}" class="bi pe-none me-2" width="22" height="22"
              alt="Egreso Icon">
            Egreso de ropa Servicio Clínico
          </a>
        </li>
        <li>
          <a href="{{ route('ingresoExterno') }}" class="nav-link text-white">
            <img src="{{ asset('imagenes/iconos/add-circle.png') }}" class="bi pe-none me-2" width="22" height="22"
              alt="Registro Icon">
            Ingreso de ropa Servicio Externo
          </a>
        </li>
        <li>
          <a href="{{ route('egresoExterno') }}" class="nav-link text-white">
            <img src="{{ asset('imagenes/iconos/remove-circle.png') }}" class="bi pe-none me-2" width="22" height="22"
              alt="Porseacaso Icon">
            Egreso de ropa Servicio Externo
          </a>
        </li>
        <li>
          <a href="{{ route('reporteInventario') }}" class="nav-link text-white">
            <img src="{{ asset('imagenes/iconos/archive.png') }}" class="bi pe-none me-2" width="22" height="22"
              alt="Porseacaso Icon">
            Generacion de reportes
          </a>
        </li>
      </ul>
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
          data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ asset('imagenes/Icono.png') }}" alt="" width="32" height="32" class="rounded-circle me-2">
          <strong>{{ Auth::user()->name }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
          <li><a class="dropdown-item" href="{{ route('perfil') }}">Perfil</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item">Cerrar Sesión</button>
            </form>
          </li>
        </ul>
      </div>
    </div>

    <div class="content">
      <div class="perfil">
        <div class="informacionPerfil">
          <h1>Perfil de usuario</h1>
          <div class="datosPerfil">
            <div class="datos">
              <h2>ID Usuario:</h2>
              <p>{{ Auth::user()->id }}</p>
              <h2>Nombre:</h2>
              <p>{{ Auth::user()->name }}</p>
            </div>
            <div class="datos">
              <h2>Correo:</h2>
              <p>{{ Auth::user()->email }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="footer1">
        <p>© 2024 LavaPlus - Versión 1.0</p>
      </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>

</html>