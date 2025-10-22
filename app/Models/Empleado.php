<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'colaborador', 'cedula', 'rh', 'genero', 'edad', 'fecha_nacimiento', 'contacto',
        'email', 'ciudad_residencia', 'direccion', 'nivel_academico', 'profesion',
        'nivel_ingles', 'hijos', 'vehiculo', 'tipo_vivienda', 'estrato', 'estado_civil',
        'eps', 'caja_pension', 'cesantias'
    ];

    // 🔗 Relaciones
    public function historialCargos()
    {
        return $this->hasMany(HistorialCargo::class);
    }

    public function llamadosAtencion()
    {
        return $this->hasManyThrough(LlamadoAtencion::class, HistorialCargo::class);
    }
}
