<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IngresoRopa;
use App\Models\IngresoExterno;

class ReporteInventarioController extends Controller
{
    public function generarReporte()
{
    // Obtener y agrupar datos de la tabla IngresoRopa
    $ropaClinicaLimpia = IngresoRopa::where('tipo_ropa', 'limpia')->sum('cantidad');
    $ropaClinicaSucia = IngresoRopa::where('tipo_ropa', 'sucia')->sum('cantidad');

    // Obtener y agrupar datos de la tabla IngresoExterno
    $ropaExternaLimpia = IngresoExterno::where('tipo_ropa', 'limpia')->sum('cantidad');
    $ropaExternaSucia = IngresoExterno::where('tipo_ropa', 'sucia')->sum('cantidad');

    // Datos agrupados en un arreglo
    $reporte = [
        'Ropa Clínica' => [
            'Limpia' => $ropaClinicaLimpia,
            'Sucia' => $ropaClinicaSucia,
        ],
        'Ropa Externa' => [
            'Limpia' => $ropaExternaLimpia,
            'Sucia' => $ropaExternaSucia,
        ],
    ];

    // Obtener las prendas únicas de ambas tablas
    $prendasClinica = IngresoRopa::distinct()->pluck('tipo_ropa_detalle');
    $prendasExterna = IngresoExterno::distinct()->pluck('tipo_ropa_detalle');

    // Combinar ambas colecciones en una sola lista de prendas
    $prendas = $prendasClinica->merge($prendasExterna)->unique();

    // Pasar los datos a la vista
    return view('reporteInventario', compact('reporte', 'prendas'));
}

// Nuevo método para obtener los datos específicos
public function obtenerDatosPrenda(Request $request)
{
    $prenda = $request->input('prenda');

    // Obtener datos específicos para la prenda seleccionada
    $ropaClinicaLimpia = IngresoRopa::where('tipo_ropa_detalle', $prenda)->where('tipo_ropa', 'limpia')->sum('cantidad');
    $ropaClinicaSucia = IngresoRopa::where('tipo_ropa_detalle', $prenda)->where('tipo_ropa', 'sucia')->sum('cantidad');

    $ropaExternaLimpia = IngresoExterno::where('tipo_ropa_detalle', $prenda)->where('tipo_ropa', 'limpia')->sum('cantidad');
    $ropaExternaSucia = IngresoExterno::where('tipo_ropa_detalle', $prenda)->where('tipo_ropa', 'sucia')->sum('cantidad');

    // Retornar los datos en formato JSON
    return response()->json([
        'ropaClinicaLimpia' => $ropaClinicaLimpia,
        'ropaClinicaSucia' => $ropaClinicaSucia,
        'ropaExternaLimpia' => $ropaExternaLimpia,
        'ropaExternaSucia' => $ropaExternaSucia,
    ]);
}


}
