<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\LlamadoAtencion;
use App\Models\Empleado;

class FormatoController extends Controller
{
    public function generarPDF(Request $request)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'cedula' => 'required|string|max:50',
            'nombre' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'fecha_evento' => 'required|date',
            'hora' => 'required|string|max:20',
            'fase' => 'required|string|max:255',
            'grupo' => 'nullable|string|max:255',
            'orientacion' => 'nullable|string',
            'detalle' => 'nullable|string',
            'jefe' => 'required|string|max:255',
            'jefe_cedula' => 'required|string|max:50',
            'cargo_jefe' => 'required|string|max:255',
            'firma_empleado' => 'required',
            'firma_jefe' => 'required',
            'jefe' => 'required|string|max:255',
            'jefe_cedula' => 'required|string|max:50',
            'cargo_jefe' => 'required|string|max:255',
            'Proceso' => 'required|string|max:255',
        
        ]);

        $empleado = Empleado::where('cedula', $validated['cedula'])->firstOrFail();


        $codigo = substr($validated['Proceso'], 0, 3);
        $detalleProceso = substr($validated['Proceso'], 4);
        $data = [

            'fecha' => $validated['fecha'],
            'cedula' => $validated['cedula'],
            'nombre' => $validated['nombre'],
            'cargo' => $validated['cargo'],
            'fecha_evento' => $validated['fecha_evento'],
            'hora' => $validated['hora'],
            'fase' => $validated['fase'],
            'grupo' => $validated['grupo'],
            'orientacion' => $validated['orientacion'],
            'detalle' => $validated['detalle'],
            'jefe' => $validated['jefe'],
            'jefe_cedula' => $validated['jefe_cedula'],
            'cargo_jefe' => $validated['cargo_jefe'],
            'firma_empleado' => $validated['firma_empleado'],
            'firma_jefe' => $validated['firma_jefe'],
            'codigo_proceso' => $codigo,
            'descripcion_proceso' => $detalleProceso,
        ];
        
        // ✅ Generar PDF
        $pdf = Pdf::loadView('plantillaPDF', compact('data'))->setPaper('A4', 'portrait');
        
        // ✅ Crear carpeta si no existe
        Storage::disk('local')->makeDirectory('llamados');
        
        // ✅ Guardar el PDF
        $fileName = 'llamados/llamado_' . $empleado->cedula . '_' . now()->format('Ymd_His') . '.pdf';
        Storage::disk('local')->put($fileName, $pdf->output());
        
        // ✅ Registrar en base de datos
        LlamadoAtencion::create([
            'empleado_id' => $empleado->id,
            'nombre' => $validated['nombre'],
            'cedula' => $validated['cedula'],
            'jefe' => $validated['jefe'],
            'jefe_cedula' => $validated['jefe_cedula'],
            'cargo_jefe' => $validated['cargo_jefe'],
            'cargo' => $validated['cargo'],
            'fecha' => $validated['fecha'],
            'fecha_evento' => $validated['fecha_evento'],
            'hora' => $validated['hora'],
            'fase' => $validated['fase'],
            'grupo' => $validated['grupo'],
            'orientacion' => $validated['orientacion'],
            'detalle' => $validated['detalle'],
            'ruta_pdf' => $fileName,
            'codigo' => $codigo,
            'descripcion' => $detalleProceso,
        ]);
        
        // ✅ Descargar PDF
        $path = Storage::disk('local')->path($fileName);
        
        return back()
        ->with('success', 'Disciplina Positiva Aplicada con exito ✅')
            ->with('pdf_path', $fileName); 
            }
            public function descargarPDF(Request $request)
{
    $path = $request->query('path');

    // Validar que el archivo exista
    if (!$path || !Storage::disk('local')->exists($path)) {
        abort(404, 'Archivo no encontrado');
    }

    // Retornar el archivo como descarga
    return response()->download(Storage::disk('local')->path($path));
}

}
