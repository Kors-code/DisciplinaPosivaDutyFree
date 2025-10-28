<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('motivos_llamados', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo');
            $table->string('descripcion');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('motivos_llamados');
    }
};
