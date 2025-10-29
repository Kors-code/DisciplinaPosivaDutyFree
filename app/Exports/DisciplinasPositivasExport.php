<?php

namespace App\Exports;

use App\Models\LlamadoAtencion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DisciplinasPositivasExport implements FromCollection, WithHeadings
{
    protected $request;

    // 🧩 Recibimos los filtros del Request
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = LlamadoAtencion::query();

        // 📅 Filtro por fecha de creación
        if ($this->request->filled('fecha_inicio') && $this->request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [
                $this->request->fecha_inicio,
                $this->request->fecha_fin
            ]);
        }

        // 🔍 Filtro por texto (nombre, cédula o id)
        if ($this->request->filled('query')) {
            $busqueda = $this->request->input('query');
            $query->where(function($q) use ($busqueda) {
                $q->where('cedula', 'like', "%$busqueda%")
                  ->orWhere('nombre', 'like', "%$busqueda%")
                  ->orWhere('id', 'like', "%$busqueda%");
            });
        }

        // 🔃 Obtener resultados filtrados
        return $query->select(
            'id',
            'nombre',
            'cedula',
            'codigo',
            'descripcion',
            'jefe',
            'jefe_cedula',
            'fase',
            'grupo',
            'orientacion',
            'detalle',
            'ruta_pdf',
            'created_at'
        )->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Colaborador',
            'Cédula',
            'Código',
            'Descripción',
            'Jefe',
            'Cédula Jefe',
            'Fase',
            'Grupo',
            'Orientación',
            'Detalle',
            'Archivo',
            'Fecha'
        ];
    }
}
