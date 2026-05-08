<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->dropColumn(['apellido', 'grado_academico', 'email']);
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->string('apellido_paterno')->after('nombre');
            $table->string('apellido_materno')->after('apellido_paterno');
            $table->string('curp')->unique()->after('apellido_materno');
            $table->string('genero')->after('curp');
        });
    }

    public function down(): void
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'apellido_paterno', 'apellido_materno', 'curp', 'genero']);
            $table->string('apellido');
            $table->string('grado_academico');
            $table->string('email');
        });
    }
};