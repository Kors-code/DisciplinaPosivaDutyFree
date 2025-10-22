<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historial_cargos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('empleado_id')->constrained('empleados')->onDelete('cascade');
    $table->string('estado')->nullable();
    $table->date('fecha_ingreso')->nullable();
    $table->string('cargo')->nullable();
    $table->string('area')->nullable();
    $table->string('funcion')->nullable();
    $table->string('jornada')->nullable();
    $table->string('tipo_contrato')->nullable();
    $table->string('jefe_inmediato')->nullable();
    $table->string('sede')->nullable();
    $table->integer('antiguedad')->nullable();
    $table->date('fecha_retiro')->nullable();
    $table->string('causa_retiro')->nullable();
    $table->string('motivo_retiro')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_cargos');
    }
};
