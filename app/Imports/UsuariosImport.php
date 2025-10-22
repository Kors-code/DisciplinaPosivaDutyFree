<?php

namespace App\Imports;

use App\Models\Empleado;
use App\Models\HistorialCargo;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class EmpleadosImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['cedula'])) {
                continue; // Saltar filas vacías
            }

            // 1️⃣ Buscar o crear empleado
            $empleado = Empleado::updateOrCreate(
                ['cedula' => $row['cedula']],
                [
                    'colaborador' => $row['colaborador'],
                    'email' => $row['email'] ?? null,
                    'contacto' => $row['contacto'] ?? null,
                    'ciudad_residencia' => $row['ciudad_residencia'] ?? null,
                    'direccion' => $row['direccion'] ?? null,
                    'nivel_academico' => $row['nivel_academico'] ?? null,
                    'profesion' => $row['profesion'] ?? null,
                    'nivel_ingles' => $row['nivel_ingles'] ?? null,
                    'rh' => $row['rh'] ?? null,
                    'genero' => $row['genero'] ?? null,
                    'edad' => $row['edad'] ?? null,
                    'fecha_nacimiento' => $row['fecha_nacimiento'] ?? null,
                    'hijos' => $row['hijos'] ?? null,
                    'vehiculo' => $row['vehiculo'] ?? null,
                    'tipo_vivienda' => $row['tipo_vivienda'] ?? null,
                    'estrato' => $row['estrato'] ?? null,
                    'estado_civil' => $row['estado_civil'] ?? null,
                    'eps' => $row['eps'] ?? null,
                    'caja_pension' => $row['caja_pension'] ?? null,
                    'cesantias' => $row['cesantias'] ?? null,
                ]
            );

            // 2️⃣ Verificar si ya tiene un registro de ese cargo en el historial
            $cargoExistente = HistorialCargo::where('empleado_id', $empleado->id)
                ->where('cargo', $row['cargo'])
                ->where('fecha_ingreso', $row['fecha_ingreso'])
                ->first();

            if (!$cargoExistente) {
                HistorialCargo::create([
                    'empleado_id' => $empleado->id,
                    'estado' => $row['estado'] ?? null,
                    'fecha_ingreso' => $row['fecha_ingreso'] ?? null,
                    'cargo' => $row['cargo'] ?? null,
                    'area' => $row['area'] ?? null,
                    'funcion' => $row['funcion'] ?? null,
                    'jornada' => $row['jornada'] ?? null,
                    'tipo_contrato' => $row['tipo_contrato'] ?? null,
                    'jefe_inmediato' => $row['jefe_inmediato'] ?? null,
                    'sede' => $row['sede'] ?? null,
                    'antiguedad' => $row['antigüedad'] ?? null,
                    'fecha_retiro' => $row['fecha_retiro'] ?? null,
                    'causa_retiro' => $row['causa_retiro'] ?? null,
                    'motivo_retiro' => $row['motivo_retiro'] ?? null,
                ]);
            }
        }
    }
}
