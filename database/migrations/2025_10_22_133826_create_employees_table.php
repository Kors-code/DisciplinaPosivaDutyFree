<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/2025_10_22_000002_create_cargos_table.php
// database/migrations/2025_10_22_000001_create_employees_table.php
public function up()
{
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('cedula', 50)->nullable()->unique();
        $table->string('colaborador', 250)->nullable();
        $table->string('estado', 50)->nullable(); // Activo / Retirado / etc
        $table->date('fecha_ingreso')->nullable();
        $table->string('area', 150)->nullable();
        $table->string('funcion', 250)->nullable();
        $table->string('jornada', 100)->nullable();
        $table->string('tipo_contrato', 100)->nullable();
        $table->string('rh', 10)->nullable();
        $table->string('genero', 20)->nullable();
        $table->integer('edad')->nullable();
        $table->date('fecha_nacimiento')->nullable();
        $table->string('contacto', 50)->nullable();
        $table->string('email', 150)->nullable();
        $table->string('ciudad_residencia', 150)->nullable();
        $table->string('direccion', 250)->nullable();
        $table->string('nivel_academico', 150)->nullable();
        $table->string('profesion', 150)->nullable();
        $table->string('nivel_ingles', 100)->nullable();
        $table->boolean('hijos')->nullable();
        $table->boolean('vehiculo')->nullable();
        $table->string('tipo_vivienda', 100)->nullable();
        $table->string('estrato', 10)->nullable();
        $table->string('estado_civil', 100)->nullable();
        $table->string('eps', 150)->nullable();
        $table->string('caja_pension', 150)->nullable();
        $table->string('cesantias', 150)->nullable();
        $table->string('jefe_inmediato', 200)->nullable();
        $table->string('sede', 150)->nullable();
        $table->string('antiguedad', 50)->nullable();
        $table->date('fecha_retiro')->nullable();
        $table->string('causa_retiro', 200)->nullable();
        $table->string('motivo_retiro', 200)->nullable();
        $table->timestamps();
        $table->softDeletes();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
