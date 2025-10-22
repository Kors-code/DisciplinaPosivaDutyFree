<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('colaborador')->nullable();
            $table->string('cedula', 50)->unique();
            $table->string('estado')->nullable();
            $table->date('fecha_ingreso')->nullable();

            // Datos personales
            $table->string('rh')->nullable();
            $table->string('genero')->nullable();
            $table->integer('edad')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('contacto')->nullable();
            $table->string('email')->nullable();
            $table->string('ciudad_residencia')->nullable();
            $table->string('direccion')->nullable();
            $table->string('nivel_academico')->nullable();
            $table->string('profesion')->nullable();
            $table->string('nivel_ingles')->nullable();
            $table->boolean('hijos')->nullable();
            $table->boolean('vehiculo')->nullable();
            $table->string('tipo_vivienda')->nullable();
            $table->string('estrato')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('eps')->nullable();
            $table->string('caja_pension')->nullable();
            $table->string('cesantias')->nullable();
            $table->string('jefe_inmediato')->nullable();
            $table->string('sede')->nullable();
            $table->string('antiguedad')->nullable();
            $table->date('fecha_retiro')->nullable();
            $table->string('causa_retiro')->nullable();
            $table->string('motivo_retiro')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
