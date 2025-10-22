<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlamadoAtencion extends Model
{
    use HasFactory;

    protected $fillable = [
        'historial_cargo_id', 'fecha', 'motivo', 'descripcion', 'tipo'
    ];

    // 🔗 Relaciones
    public function historialCargo()
    {
        return $this->belongsTo(HistorialCargo::class);
    }

    public function empleado()
    {
        return $this->hasOneThrough(Empleado::class, HistorialCargo::class);
    }
}
