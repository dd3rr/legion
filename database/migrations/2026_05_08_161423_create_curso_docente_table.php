<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('curso_docente');
        
        Schema::create('curso_docente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curso_id');
            $table->unsignedBigInteger('docente_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curso_docente');
    }
};