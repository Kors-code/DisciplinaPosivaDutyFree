<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/2025_10_22_000003_create_employee_positions_table.php
public function up()
{
    Schema::create('employee_positions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
        $table->foreignId('cargo_id')->nullable()->constrained('cargos')->onDelete('set null');
        $table->string('titulo', 200)->nullable(); // redundancia para trazabilidad
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable(); // NULL = vigente
        $table->string('motivo', 200)->nullable(); // traslado, ascenso, retiro
        $table->timestamps();
        $table->softDeletes();
        $table->index(['employee_id','start_date','end_date']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_positions');
    }
};
