<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialCargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id', 'estado', 'fecha_ingreso', 'cargo', 'area', 'funcion', 
        'jornada', 'tipo_contrato', 'jefe_inmediato', 'sede', 'antiguedad',
        'fecha_retiro', 'causa_retiro', 'motivo_retiro'
    ];

    // 🔗 Relaciones
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function llamadosAtencion()
    {
        return $this->hasMany(LlamadoAtencion::class);
    }
}
