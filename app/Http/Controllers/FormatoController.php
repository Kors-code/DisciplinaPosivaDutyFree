<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FormatoController extends Controller
{
    public function generarPDF(Request $request)
    {
        // Recoger solo los campos que necesitamos
        $data = $request->only([
            'fecha', 'nombre', 'cedula', 'cargo',
            'jefe', 'jefe_cedula', 'cargo_jefe',
            'fecha_evento', 'hora', 'fase', 'grupo',
            'orientacion', 'detalle', 'firma_empleado',
             'firma_jefe'
        ]);

        // Si quieres debug: \Log::info($data);

        // Generar PDF con la vista 'plantillaPDF'
        $pdf = Pdf::loadView('plantillaPDF', compact('data'))->setPaper('A4', 'portrait');

        // Descargar
        return $pdf->download('asesoramiento_verbal.pdf');
        // Si prefieres mostrar en navegador:
        // return $pdf->stream('asesoramiento_verbal.pdf');
    }
}
