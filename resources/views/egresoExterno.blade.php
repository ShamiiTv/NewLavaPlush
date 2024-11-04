<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
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
            <a class="nav-link" aria-disabled="true">{{ Auth::user()->name }}</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="d-flex">
    <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-bg-dark">
      <a class="nav-link" aria-disabled="true">{{ Auth::user()->name }}</a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="{{ route('inicio') }}" class="nav-link" aria-current="page">
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
          <a href="{{ route('egresoExterno') }}" class="nav-link active">
            <img src="{{ asset('imagenes/iconos/remove-circle.png') }}" class="bi pe-none me-2" width="22" height="22"
              alt="Porseacaso Icon">
            Egreso de ropa Servicio Externo
          </a>
        </li>
        <li>
          <a href="{{ route('generacionInformes') }}" class="nav-link text-white">
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
          <li><a class="dropdown-item" href="#">Perfil</a></li>
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
      <div class="egresoRopa">
        <h1 class="my-4">Egreso de Ropa - Servicio Externo</h1>
        @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
        @if($errors->any())
      <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
        </ul>
      </div>
    @endif

        <form action="{{ route('egresoExterno') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="tipo_ropa" class="form-label">Tipo de Ropa</label>
            <select class="form-select" name="tipo_ropa" id="tipo_ropa" required onchange="actualizarTipoRopaDetalle()">
              <option value="">Seleccione el tipo de ropa</option>
              <option value="limpia">Limpia</option>
              <option value="sucia">Sucia</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="tipo_ropa_detalle" class="form-label">Detalle del Tipo de Ropa</label>
            <select class="form-select" name="tipo_ropa_detalle" id="tipo_ropa_detalle" required>
              <option value="">Seleccione el detalle</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad a Egresar</label>
            <input type="number" class="form-control" name="cantidad" id="cantidad" min="1" required>
          </div>

          <button type="submit" class="btn btn-danger">Registrar Egreso</button>
          <a href="{{ route('inicio') }}" class="btn btn-secondary">Cancelar</a>
        </form>
      </div>

      <div class="container mt-4">
        <h5>Registros de Egreso de ropa servicio Externo</h5>
        <table class="table table-striped">
    <thead>
        <tr>
            <th>Estado</th>
            <th>Tipo de ropa</th>
            <th>Ultima Cantidad Egresada</th>
            <th>Cantidad Actual</th>
            <th>Usuario</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
    @foreach($egresosRopa as $egreso)
        <tr>
            <td>{{ ucfirst($egreso->tipo_ropa) }}</td>
            <td>{{ $egreso->tipo_ropa_detalle }}</td>
            <td>{{ $egreso->ultima_cantidad_egresada ?? 0 }}</td>
            <td>{{ $egreso->cantidad }}</td>
            <td>{{ $egreso->user->name ?? 'Desconocido' }}</td>
            <td>{{ $egreso->created_at->timezone('America/Santiago')->format('d/m/Y H:i') }}</td>
        </tr>
    @endforeach
</tbody>
</table>
      </div>

    </div>

  </div>
  <div class="footer1">
    <p>© 2024 LavaPlus - Versión 1.0</p>
  </div>
  </div>

  <script>
    const tiposPrendasLimpias = @json($tiposPrendasLimpias);
    const tiposPrendasSucias = @json($tiposPrendasSucias);

    function actualizarTipoRopaDetalle() {
      const tipoRopa = document.getElementById("tipo_ropa").value;
      const tipoRopaDetalle = document.getElementById("tipo_ropa_detalle");

      tipoRopaDetalle.innerHTML = '<option value="">Seleccione el detalle</option>';

      const opciones = tipoRopa === "limpia" ? tiposPrendasLimpias : tipoRopa === "sucia" ? tiposPrendasSucias : [];

      opciones.forEach(tipo => {
        const option = document.createElement("option");
        option.value = tipo;
        option.textContent = tipo;
        tipoRopaDetalle.appendChild(option);
      });
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz4fnFO9gybO3AL1H6C53Ph1+NTFcH3Nn4V+74h6Q3b/6XnxTfYeq4OW6w" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-2c1n6ovf58KjRsP2HxErg4MBsmipbGy3Hyxgf9kvlW3lFv0+wY5vEGXHQI8rViJW" crossorigin="anonymous">
  </script>
</body>

</html>
