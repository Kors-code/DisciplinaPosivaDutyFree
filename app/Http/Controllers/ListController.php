<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\LlamadoAtencion;
use App\Exports\EmpleadosExport;
use App\Exports\DisciplinasPositivasExport;
use Maatwebsite\Excel\Facades\Excel;

class ListController extends Controller
{
    
   public function mostrarEmpleados(Request $request)
{
    $query = Empleado::query();

    // 🔍 Filtro por texto (nombre o cédula)
    if ($request->filled('query')) {
        $busqueda = $request->input('query');
        $query->where(function ($q) use ($busqueda) {
            $q->where('colaborador', 'like', "%$busqueda%")
              ->orWhere('cedula', 'like', "%$busqueda%");
        });
    }

    // 📅 Filtro por rango de fechas de nacimiento
    if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
        $query->whereBetween('fecha_ingreso', [
            $request->fecha_inicio,
            $request->fecha_fin
        ]);
    }

    // 🟢 Filtro por estad
    if ($request->filled('estado')) {
        $query->where('estado', $request->estado);
    }

    // 🔃 Obtener resultados ordenados
    $empleados = $query->orderBy('colaborador', 'asc')->get();

    return view('Listas.Empleados', compact('empleados'));
}


   public function mostrarDisciplinasPositivas(Request $request)
    {
        $query = LlamadoAtencion::query();

        // 🔍 Filtro por fecha (si ambos campos tienen valor)
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [
                $request->fecha_inicio,
                $request->fecha_fin
            ]);
        }

        // 🔍 Filtro por texto (nombre, cédula o id)
        if ($request->filled('query')) {
            $busqueda = $request->input('query');
            $query->where(function($q) use ($busqueda) {
                $q->where('cedula', 'like', "%$busqueda%")
                  ->orWhere('nombre', 'like', "%$busqueda%")
                  ->orWhere('id', 'like', "%$busqueda%");
            });
        }


        // 🔃 Obtener resultados
        $LlamadoAtencion = $query->orderBy('created_at', 'desc')->get();

        return view('Listas.Disciplinas_Positivas', compact('LlamadoAtencion'));
    }

        public function exportarEmpleadosExcel(Request $request)
        {
            return Excel::download(new EmpleadosExport($request), 'Empleados.xlsx');
        }

        public function exportarDisciplinasExcel(Request $request)
        {
            return Excel::download(new DisciplinasPositivasExport($request), 'Disciplinas_Positivas.xlsx');
        }


}
