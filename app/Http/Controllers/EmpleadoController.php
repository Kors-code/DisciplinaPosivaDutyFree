<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmpleadosImport;

class EmpleadoController extends Controller
{
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            Excel::import(new EmpleadosImport, $request->file('file'));
        } catch (\Throwable $e) {
            // registra error si quieres en storage/logs/laravel.log
            \Log::error('Error importando empleados: ' . $e->getMessage());
            return back()->withErrors(['file' => 'Error al importar: ' . $e->getMessage()]);
        }

        return back()->with('success', 'Importación completada correctamente.');
    }
    public function buscarPorCedula($cedula)
{
    $empleado = \App\Models\Empleado::where('cedula', $cedula)->first();

    if (!$empleado) {
        return response()->json([
            'success' => false,
            'message' => 'Empleado no encontrado'
        ], 404);
    }

    // Buscar el último cargo registrado del empleado
    $historial = $empleado->historialCargos()
        ->with('cargo') // para traer el nombre del cargo desde la relación
        ->latest('fecha_ingreso')
        ->first();

    return response()->json([
        'success' => true,
        'nombre' => $empleado->colaborador,
        'cargo' => $historial && $historial->cargo ? $historial->cargo->nombre : 'Sin cargo registrado'
    ]);
}
}
