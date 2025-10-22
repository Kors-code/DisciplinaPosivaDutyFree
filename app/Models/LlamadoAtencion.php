<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Llamado extends Model
{
    use HasFactory;

    protected $table = 'llamados';

    protected $fillable = [
        'empleado_id','tipo','fecha','descripcion','accion_tomada'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
