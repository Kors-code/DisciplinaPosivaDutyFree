<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsuariosImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class ExcelController extends Controller
{
    public function showForm()
    {
        return view('Subir_Datos.Subir_Personal');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);
        $file = $request->file('file');

        $collection = Excel::toCollection(null, $file);


        Excel::import(new UsuariosImport, $request->file('file'));

        return back()->with('success', 'Datos importados correctamente.');
    }
}
