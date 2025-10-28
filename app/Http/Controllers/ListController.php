<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\LlamadoAtencion;

class ListController extends Controller
{
    
    public function mostrarEmpleados()
    {
        $empleados = Empleado::all();
        return view('Listas.Empleados', compact('empleados'));
    }
    public function mostrarDisciplinasPositivas()
    {
        $LlamadoAtencion = LlamadoAtencion::all();
        return view('Listas.Disciplinas_Positivas', compact('LlamadoAtencion'));
    }

}
