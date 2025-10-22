<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/2025_10_22_000004_create_llamados_atencion_table.php
public function up()
{
    Schema::create('llamados_atencion', function (Blueprint $table) {
    $table->id();
    $table->foreignId('historial_cargo_id')->constrained('historial_cargos')->onDelete('cascade');
    $table->date('fecha');
    $table->string('motivo');
    $table->text('descripcion')->nullable();
    $table->string('tipo')->nullable(); // leve, grave, etc.
    $table->timestamps();
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('llamados_atencion');
    }
};
