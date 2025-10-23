<?php

namespace App\Imports;

use App\Models\Empleado;
use App\Models\Cargo;
use App\Models\HistorialCargo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;

class EmpleadosImport implements ToCollection, WithHeadingRow
{
    // Normaliza una clave: quita tildes, pasa a minúscula y convierte no alfanum a guión bajo
    protected function normalizeKey($key)
    {
        if (is_null($key)) return null;
        $key = trim($key);
        // quitar tildes
        $trans = [
            'Á'=>'A','À'=>'A','Â'=>'A','Ä'=>'A','á'=>'a','à'=>'a','â'=>'a','ä'=>'a',
            'É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E','é'=>'e','è'=>'e','ê'=>'e','ë'=>'e',
            'Í'=>'I','Ì'=>'I','Î'=>'I','Ï'=>'I','í'=>'i','ì'=>'i','î'=>'i','ï'=>'i',
            'Ó'=>'O','Ò'=>'O','Ô'=>'O','Ö'=>'O','ó'=>'o','ò'=>'o','ô'=>'o','ö'=>'o',
            'Ú'=>'U','Ù'=>'U','Û'=>'U','Ü'=>'U','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u',
            'Ñ'=>'N','ñ'=>'n'
        ];
        $key = strtr($key, $trans);
        $key = mb_strtolower($key);
        // cambia todo lo que no sea letra/número en underscore
        $key = preg_replace('/[^a-z0-9]+/u', '_', $key);
        $key = trim($key, '_');
        return $key;
    }

    protected function parseDate($value)
    {
        if ($value === null || $value === '') {
            return null;
        }
        // si es numérico (fecha Excel)
        if (is_numeric($value)) {
            try {
                $dt = ExcelDate::excelToDateTimeObject($value);
                return Carbon::instance($dt)->format('Y-m-d');
            } catch (\Throwable $e) {
                return null;
            }
        }
        // intentar parsear con Carbon
        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $rawRow) {
            // construir array normalizado de la fila
            $row = [];
            foreach ($rawRow->toArray() as $k => $v) {
                $nk = $this->normalizeKey($k);
                $row[$nk] = $v;
            }

            // claves que vamos a usar (seguras)
            $cedula = trim((string) ($row['cedula'] ?? ''));
            if ($cedula === '') {
                // ignorar filas sin cédula
                continue;
            }

            // parsear fechas principales
            $fecha_ingreso = $this->parseDate($row['fecha_ingreso'] ?? ($row['fecha_ingreso'] ?? null));
            $fecha_nacimiento = $this->parseDate($row['fecha_nacimiento'] ?? null);
            $fecha_retiro = $this->parseDate($row['fecha_retiro'] ?? null);

            // crear/actualizar empleado (no sobreescribimos con NULL)
            $empleadoData = array_filter([
                'colaborador' => $row['colaborador'] ?? null,
                'email' => $row['email'] ?? null,
                'contacto' => $row['contacto'] ?? null,
                'ciudad_residencia' => $row['ciudad_residencia'] ?? null,
                'direccion' => $row['direccion'] ?? null,
                'nivel_academico' => $row['nivel_academico'] ?? null,
                'profesion' => $row['profesion'] ?? null,
                'nivel_ingles' => $row['nivel_ingles'] ?? null,
                'rh' => $row['rh'] ?? null,
                'genero' => $row['genero'] ?? null,
                'edad' => is_numeric($row['edad'] ?? null) ? intval($row['edad']) : null,
                'fecha_nacimiento' => $fecha_nacimiento,
                'hijos' => isset($row['hijos']) ? (bool) $row['hijos'] : null,
                'vehiculo' => isset($row['vehiculo']) ? (bool) $row['vehiculo'] : null,
                'tipo_vivienda' => $row['tipo_vivienda'] ?? null,
                'estrato' => $row['estrato'] ?? null,
                'estado_civil' => $row['estado_civil'] ?? null,
                'eps' => $row['eps'] ?? null,
                'caja_pension' => $row['caja_pension'] ?? null,
                'cesantias' => $row['cesantias'] ?? null,
                'jefe_inmediato' => $row['jefe_inmediato'] ?? null,
                'sede' => $row['sede'] ?? null,
                'antiguedad' => $row['antiguedad'] ?? ($row['antiguedad'] ?? null),
                'fecha_retiro' => $fecha_retiro,
                'estado' => $row['estado'] ?? null,
                'colaborador' => $row['colaborador'] ?? null,
                'fecha_ingreso' => $fecha_ingreso,
            ], function ($v) { return !is_null($v) && $v !== ''; });

            $empleado = Empleado::updateOrCreate(
                ['cedula' => $cedula],
                $empleadoData
            );

            // CARGO: crear o buscar
            $cargoNombre = trim((string) ($row['cargo'] ?? ''));
            $cargoId = null;
            if ($cargoNombre !== '') {
                $cargo = Cargo::firstOrCreate(['nombre' => $cargoNombre], [
                    'area' => $row['area'] ?? null,
                    'funcion' => $row['funcion'] ?? null,
                    'jornada' => $row['jornada'] ?? null,
                    'tipo_contrato' => $row['tipo_contrato'] ?? null,
                ]);
                $cargoId = $cargo->id;
            }

            // Buscar historial existente (empleado + cargo + fecha_ingreso)
            $histQuery = HistorialCargo::where('empleado_id', $empleado->id);

            if ($cargoId) {
                $histQuery->where('cargo_id', $cargoId);
            } else {
                // si no hay cargo_id, intentar emparejar por titulo (si fue guardado)
                $histQuery->whereNull('cargo_id');
            }

            if ($fecha_ingreso) {
                $histQuery->whereDate('fecha_ingreso', $fecha_ingreso);
            }

            $hist = $histQuery->first();

            if (! $hist) {
                HistorialCargo::create([
                    'empleado_id' => $empleado->id,
                    'cargo_id' => $cargoId,
                    'fecha_ingreso' => $fecha_ingreso,
                    'fecha_retiro' => $fecha_retiro,
                    'estado' => $row['estado'] ?? null,
                    'area' => $row['area'] ?? null,
                    'funcion' => $row['funcion'] ?? null,
                    'jornada' => $row['jornada'] ?? null,
                    'tipo_contrato' => $row['tipo_contrato'] ?? null,
                    'jefe_inmediato' => $row['jefe_inmediato'] ?? null,
                    'sede' => $row['sede'] ?? null,
                    'antiguedad' => $row['antiguedad'] ?? ($row['antiguedad'] ?? null),
                    'causa_retiro' => $row['causa_retiro'] ?? null,
                    'motivo_retiro' => $row['motivo_retiro'] ?? null,
                ]);
            } else {
                // actualizar si hay nueva info
                $hist->update(array_filter([
                    'fecha_retiro' => $fecha_retiro ?? $hist->fecha_retiro,
                    'area' => $row['area'] ?? $hist->area,
                    'funcion' => $row['funcion'] ?? $hist->funcion,
                    'jornada' => $row['jornada'] ?? $hist->jornada,
                    'tipo_contrato' => $row['tipo_contrato'] ?? $hist->tipo_contrato,
                    'jefe_inmediato' => $row['jefe_inmediato'] ?? $hist->jefe_inmediato,
                    'sede' => $row['sede'] ?? $hist->sede,
                    'antiguedad' => $row['antiguedad'] ?? $hist->antiguedad,
                    'causa_retiro' => $row['causa_retiro'] ?? $hist->causa_retiro,
                    'motivo_retiro' => $row['motivo_retiro'] ?? $hist->motivo_retiro,
                ], function ($v) { return !is_null($v) && $v !== ''; }));
            }
        }
    }


}
