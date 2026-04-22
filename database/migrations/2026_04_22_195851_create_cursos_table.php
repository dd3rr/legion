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
        Schema::create('cursos', function (Blueprint $table) {
        $table->id(); // ID único
        $table->string('clave')->unique(); // Ej: MAT-101
        $table->string('nombre');
        $table->date('fecha_inicio');
        $table->date('fecha_fin');
        $table->time('hora_inicio');
        $table->time('hora_fin');
        $table->timestamps(); // Registra cuándo se creó y actualizó
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
