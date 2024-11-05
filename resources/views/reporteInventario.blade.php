


<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Inventario</title>
    <link rel="stylesheet" href="{{ asset('css/reportes.css') }}">
    <link rel="icon" href="{{ asset('imagenes/logo/logo2lavaplus.png') }}" type="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-bg-dark">
    <a class="nav-link" aria-disabled="true">
    <span class="icon-container">
        <img src="{{ asset('imagenes/iconos/usuario.png') }}" style="margin: 3px" alt="Usuario"  width="20" height="20">
    </span>
    <span>{{ Auth::user()->name }}</span>
</a>
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
                <a href="{{ route('reporteInventario') }}" class="nav-link active">
                    <img src="{{ asset('imagenes/iconos/archive.png') }}" class="bi pe-none me-2" width="22" height="22"
                         alt="Porseacaso Icon">
                    Generación de reportes
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
        <div class="contenedor">
                <div class="container mt-5 text-center">
                    <div class="card mx-auto" style="max-width: 800px;">
                        <div class="card-header">
                            <h5 class="tituloIRSC">Reporte de Inventario</h5>
                            <div class="lineaSeparadora"></div>
                        </div>
                        <div class="card-body">
                        
                            <div class="mb-4">
                                <label for="tipoPrenda" class="form-label">Seleccione la Prenda:</label>
                                <select id="tipoPrenda" class="form-select" onchange="mostrarCantidad()">
                                    <option value="">-- Seleccione --</option>
                                    @foreach($prendas as $prenda)
                                        <option value="{{ $prenda }}">{{ $prenda }}</option>
                                    @endforeach
                                </select>
                            </div>

                        
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tipo de Ropa</th>
                                        <th>Limpia</th>
                                        <th>Sucia</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaInventario">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
        </div>
        <div class="footer1">
    <p>© 2024 LavaPlus - Versión 1.0</p>
</div>
    </div>


<script>
    function mostrarCantidad() {
        const prendaSeleccionada = document.getElementById('tipoPrenda').value;
        const tabla = document.getElementById('tablaInventario');

        // Limpiar la tabla antes de agregar nuevas filas
        tabla.innerHTML = '';

        if (prendaSeleccionada) {
            // Solicitar los datos específicos para la prenda seleccionada
            fetch('/ruta-a-obtener-datos?prenda=' + prendaSeleccionada)
                .then(response => response.json())
                .then(data => {
                    // Crear la fila para Ropa Clínica
                    const rowClinica = document.createElement('tr');
                    rowClinica.innerHTML = `
                        <td>Ropa Clínica </td>
                        <td>${data.ropaClinicaLimpia}</td>
                        <td>${data.ropaClinicaSucia}</td>
                    `;
                    tabla.appendChild(rowClinica);

                    // Crear la fila para Ropa Externa
                    const rowExterna = document.createElement('tr');
                    rowExterna.innerHTML = `
                        <td>Ropa Externa </td>
                        <td>${data.ropaExternaLimpia}</td>
                        <td>${data.ropaExternaSucia}</td>
                    `;
                    tabla.appendChild(rowExterna);
                })
                .catch(error => {
                    console.error('Error al obtener los datos:', error);
                });
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
