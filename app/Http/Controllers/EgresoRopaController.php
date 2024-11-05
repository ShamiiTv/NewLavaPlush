<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IngresoRopa;

class EgresoRopaController extends Controller
{
    public function showForm2()
    {
        $tiposPrendasLimpias = IngresoRopa::where('tipo_ropa', 'limpia')
            ->where('cantidad', '>', 0)
            ->distinct('tipo_ropa_detalle')
            ->pluck('tipo_ropa_detalle');

        $tiposPrendasSucias = IngresoRopa::where('tipo_ropa', 'sucia')
            ->where('cantidad', '>', 0)
            ->distinct('tipo_ropa_detalle')
            ->pluck('tipo_ropa_detalle');

        $egresosRopa = IngresoRopa::with('user')->where('cantidad', '>', 0)->get();

        return view('egresoInterno', [
            'tiposPrendasLimpias' => $tiposPrendasLimpias,
            'tiposPrendasSucias' => $tiposPrendasSucias,
            'egresosRopa' => $egresosRopa
        ]);
    }
    
    public function store2(Request $request)
{
    $request->validate([
        'tipo_ropa' => 'required|in:limpia,sucia',
        'tipo_ropa_detalle' => 'nullable|string',
        'cantidad' => 'required|integer|min:1',
    ]);

    $tipoRopaDetalle = $request->input('tipo_ropa_detalle');
    $tipoRopa = $request->input('tipo_ropa');
    $cantidadEgresada = $request->input('cantidad');

    $ingresoInterno = IngresoRopa::where('tipo_ropa', $tipoRopa)
        ->where('tipo_ropa_detalle', $tipoRopaDetalle)
        ->first();

    if (!$ingresoInterno || $ingresoInterno->cantidad < $cantidadEgresada) {
        return redirect()->back()->withErrors(['cantidad' => 'Cantidad insuficiente para el egreso.'])->withInput();
    }

    // Guardar la cantidad actual antes del egreso
    $cantidadActualAntes = $ingresoInterno->cantidad;

    // Actualizar la cantidad después del egreso
    $ingresoInterno->cantidad -= $cantidadEgresada;

    // Actualizar la última cantidad egresada
    $ingresoInterno->ultima_cantidad_egresada = $cantidadEgresada;

    $ingresoInterno->save();

    return redirect()->route('egresoInterno')->with([
        'success' => 'Egreso registrado exitosamente.',
        'cantidad_egresada' => $ingresoInterno,
        'cantidad_actual' => $ingresoInterno->cantidad,
        'tipo_ropa' => $tipoRopa,
        'tipo_ropa_detalle' => $tipoRopaDetalle
    ]);
}




















}


