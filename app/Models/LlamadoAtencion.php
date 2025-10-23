<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlamadoAtencion extends Model
{
    use HasFactory;

    protected $table = 'llamados_atencion';

    protected $fillable = [
    'empleado_id',
    'nombre',
    'cedula',
    'jefe',
    'jefe_cedula',
    'fecha',
    'fecha_evento',
    'hora',
    'fase',
    'grupo',
    'orientacion',
    'detalle',
    'ruta_pdf',
];


    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
