<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IngresoExterno; 

class IngresoExternoController extends Controller
{
    public function showForm()
    {
        $tiposPrendas = IngresoExterno::distinct('tipo_ropa_detalle')->pluck('tipo_ropa_detalle'); // Cambiar a IngresoExterno
        $ingresosRopa = IngresoExterno::with('user')->get(); // Cambiar a IngresoExterno
        return view('ingresoExterno', ['tiposPrendas' => $tiposPrendas, 'ingresosRopa' => $ingresosRopa]); // Cambiar la vista a ingresoExterno
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_ropa' => 'required|in:limpia,sucia',
            'tipo_ropa_detalle' => 'nullable|string',
            'tipo_ropa_detalle_otro' => 'nullable|string',
            'cantidad' => 'required|integer|min:1',
        ]);

        $tipoRopaDetalle = $request->input('tipo_ropa_detalle');
        $tipoRopa = $request->input('tipo_ropa');

        if ($tipoRopaDetalle === 'otro') {
            $tipoRopaDetalle = $request->input('tipo_ropa_detalle_otro');

            if (empty($tipoRopaDetalle)) {
                return redirect()->back()->withErrors(['tipo_ropa_detalle_otro' => 'Especificar tipo de prenda es obligatorio cuando se selecciona "Otro".'])->withInput();
            }
        }

        if (!$tipoRopaDetalle && $tipoRopa !== 'otro') {
            $tipoRopaDetalle = 'No especificado';
        }

        $ingresoExterno = IngresoExterno::where('tipo_ropa', $tipoRopa) // Cambiar a IngresoExterno
            ->where('tipo_ropa_detalle', $tipoRopaDetalle)
            ->first();

        if ($ingresoExterno) {
            $ingresoExterno->cantidad += $request->input('cantidad');
            $ingresoExterno->save();
        } else {
            IngresoExterno::create([ // Cambiar a IngresoExterno
                'tipo_ropa' => $tipoRopa,
                'tipo_ropa_detalle' => $tipoRopaDetalle,
                'cantidad' => $request->input('cantidad'),
                'user_id' => auth()->id(), // Asignar el user_id
            ]);
        }

        return redirect()->route('ingresoExterno')->with('success', 'Ingreso registrado exitosamente.'); // Cambiar la ruta a ingresoExterno
    }

    public function getTipoRopaDetalles()
    {
        $tiposRopaDetalles = IngresoExterno::distinct('tipo_ropa_detalle') // Cambiar a IngresoExterno
            ->pluck('tipo_ropa_detalle');
        return response()->json($tiposRopaDetalles);
    }
}
