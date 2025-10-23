<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('llamados_atencion', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('nombre');
            $table->string('cedula');
            $table->string('cargo')->nullable();
            $table->string('jefe');
            $table->string('jefe_cedula');
            $table->string('cargo_jefe')->nullable();
            $table->date('fecha_evento');
            $table->string('hora');
            $table->string('fase');
            $table->string('grupo')->nullable();
            $table->text('orientacion')->nullable();
            $table->text('detalle')->nullable();
            $table->string('firma_empleado')->nullable();
            $table->string('firma_jefe')->nullable();
            $table->string('ruta_pdf'); // aquí guardaremos la ruta del archivo PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('llamados_atencion');
    }
};
