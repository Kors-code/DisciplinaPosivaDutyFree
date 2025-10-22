<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'cedula';
    public $incrementing = false; // Si la clave primaria no es auto-incremental
    protected $keyType = 'string'; // Si la clave primaria no es un entero

    protected $fillable = [
        'cedula',
        'colaborador',
        'email',
        'cargo',
        'contacto',
    ];
}
