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
public function up()
{
    Schema::create('cargos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 200)->unique();
        $table->text('descripcion')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
