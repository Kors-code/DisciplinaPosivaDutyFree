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
}
