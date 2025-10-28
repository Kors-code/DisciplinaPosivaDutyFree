<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertaInterna extends Model
{
    use HasFactory;

    protected $table = 'alertas_internas';

    protected $fillable = [
        'codigo',
        'descripcion'
    ];
}
