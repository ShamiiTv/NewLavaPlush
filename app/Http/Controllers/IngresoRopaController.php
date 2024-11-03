<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IngresoRopa;

class IngresoRopaController extends Controller
{
    public function showForm()
    {
        $tiposPrendas = IngresoRopa::distinct('tipo_ropa_detalle')->pluck('tipo_ropa_detalle');
        $ingresosRopa = IngresoRopa::with('user')->get(); 
        return view('ingresoInterno', ['tiposPrendas' => $tiposPrendas, 'ingresosRopa' => $ingresosRopa]);
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

        $ingresoRopa = IngresoRopa::where('tipo_ropa', $tipoRopa)
            ->where('tipo_ropa_detalle', $tipoRopaDetalle)
            ->first();

        if ($ingresoRopa) {
            $ingresoRopa->cantidad += $request->input('cantidad');
            $ingresoRopa->save();
        } else {
            IngresoRopa::create([
                'tipo_ropa' => $tipoRopa,
                'tipo_ropa_detalle' => $tipoRopaDetalle,
                'cantidad' => $request->input('cantidad'),
                'user_id' => auth()->id(), // Asignar el user_id
            ]);
        }

        return redirect()->route('ingresoInterno')->with('success', 'Ingreso registrado exitosamente.');
    }





    public function getTipoRopaDetalles()
    {
        $tiposRopaDetalles = IngresoRopa::distinct('tipo_ropa_detalle')
            ->pluck('tipo_ropa_detalle');
        return response()->json($tiposRopaDetalles);
    }


}
