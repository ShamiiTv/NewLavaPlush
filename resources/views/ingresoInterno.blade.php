<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
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
                        <a class="nav-link" aria-disabled="true">{{Auth::user()->name}}</a>
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
          <a href="{{ route('inicio') }}" class="nav-link text-white" aria-current="page">
            <img src="{{ asset('imagenes/iconos/home.png') }}" class="bi pe-none me-2" width="22" height="22"
              alt="Inicio Icon">
            Inicio
          </a>
        </li>
        <li>
          <a href="{{ route('ingresoInterno') }}" class="nav-link active">
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
            <div class="contenedor">
                <h5 class="tituloIRSC"> Ingreso de ropa Servicio Clinico</h5>
                <div class="lineaSeparadora"></div>
                <form action="{{ url('/ingresoInterno') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tipo de prenda</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="tipoRopaDetalle" name="tipo_ropa_detalle" required>
                                <option value="" disabled selected>Selecciona el tipo de prenda</option>
                                @foreach ($tiposPrendas as $tipoPrenda)
                                    <option value="{{ $tipoPrenda }}">{{ ucfirst($tipoPrenda) }}</option>
                                @endforeach
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="tipoRopaOtroWrapper" style="display: none;">
                        <label class="col-sm-2 col-form-label">Especificar tipo de prenda</label>
                        <div class="col-sm-10 mt-4">
                            <input type="text" class="form-control" id="tipoRopaOtro" name="tipo_ropa_detalle_otro"
                                placeholder="Especificar tipo de prenda">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Estado de ropa</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_ropa" id="tipoRopaLimpia"
                                    value="limpia" checked>
                                <label class="form-check-label" for="tipoRopaLimpia">Ropa Limpia</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_ropa" id="tipoRopaSucia"
                                    value="sucia">
                                <label class="form-check-label" for="tipoRopaSucia">Ropa Sucia</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Cantidad</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="cantidad" placeholder="Cantidad" required>
                        </div>
                    </div>
                    <div class="contenedorBoton">
                        <button type="submit" class="btn2">Registrar</button>
                    </div>
                </form>
            </div>
            <div class="container mt-4">
                <h5>Registros de Ingreso de Ropa</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Estado</th>
                            <th>Tipo de ropa</th>
                            <th>Cantidad</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ingresosRopa as $ingreso)
                            <tr>
                                <td>{{ ucfirst($ingreso->tipo_ropa) }}</td>
                                <td>{{ $ingreso->tipo_ropa_detalle }}</td>
                                <td>{{ $ingreso->cantidad }}</td>
                                <td>{{ $ingreso->user->name ?? 'Desconocido' }}</td>
                                <td>{{ $ingreso->created_at->timezone('America/Santiago')->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Éxito!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#54c45e',
                customClass: {
                    confirmButton: 'btn-custom'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        @endif
    </script>
</body>

</html>