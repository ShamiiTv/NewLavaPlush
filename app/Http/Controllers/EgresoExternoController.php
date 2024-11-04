<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IngresoExterno;

class EgresoExternoController extends Controller
{
    public function showForm()
    {
        $tiposPrendasLimpias = IngresoExterno::where('tipo_ropa', 'limpia')
            ->where('cantidad', '>', 0)
            ->distinct('tipo_ropa_detalle')
            ->pluck('tipo_ropa_detalle');

        $tiposPrendasSucias = IngresoExterno::where('tipo_ropa', 'sucia')
            ->where('cantidad', '>', 0)
            ->distinct('tipo_ropa_detalle')
            ->pluck('tipo_ropa_detalle');

        $egresosRopa = IngresoExterno::with('user')->where('cantidad', '>', 0)->get();

        return view('egresoExterno', [
            'tiposPrendasLimpias' => $tiposPrendasLimpias,
            'tiposPrendasSucias' => $tiposPrendasSucias,
            'egresosRopa' => $egresosRopa
        ]);
    }


    public function store(Request $request)
{
    $request->validate([
        'tipo_ropa' => 'required|in:limpia,sucia',
        'tipo_ropa_detalle' => 'nullable|string',
        'cantidad' => 'required|integer|min:1',
    ]);

    $tipoRopaDetalle = $request->input('tipo_ropa_detalle');
    $tipoRopa = $request->input('tipo_ropa');
    $cantidadEgresada = $request->input('cantidad');

    $ingresoExterno = IngresoExterno::where('tipo_ropa', $tipoRopa)
        ->where('tipo_ropa_detalle', $tipoRopaDetalle)
        ->first();

    if (!$ingresoExterno || $ingresoExterno->cantidad < $cantidadEgresada) {
        return redirect()->back()->withErrors(['cantidad' => 'Cantidad insuficiente para el egreso.'])->withInput();
    }

    // Guardar la cantidad actual antes del egreso
    $cantidadActualAntes = $ingresoExterno->cantidad;

    // Actualizar la cantidad después del egreso
    $ingresoExterno->cantidad -= $cantidadEgresada;

    // Actualizar la última cantidad egresada
    $ingresoExterno->ultima_cantidad_egresada = $cantidadEgresada;

    $ingresoExterno->save();

    return redirect()->route('egresoExterno')->with([
        'success' => 'Egreso registrado exitosamente.',
        'cantidad_egresada' => $cantidadEgresada,
        'cantidad_actual' => $ingresoExterno->cantidad,
        'tipo_ropa' => $tipoRopa,
        'tipo_ropa_detalle' => $tipoRopaDetalle
    ]);
}


}
