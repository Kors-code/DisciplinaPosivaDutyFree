<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialCargo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'historial_cargos';

    protected $fillable = [
        'empleado_id','cargo_id','fecha_ingreso','fecha_retiro','estado','area','funcion','jornada','tipo_contrato',
        'jefe_inmediato','sede','antiguedad','causa_retiro','motivo_retiro'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }

    public function llamados()
    {
        return $this->hasMany(Llamado::class, 'historial_cargo_id');
    }
}
