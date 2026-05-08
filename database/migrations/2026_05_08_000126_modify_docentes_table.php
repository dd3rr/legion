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
    Schema::table('docentes', function (Blueprint $table) {

        $table->string('apellido_paterno')->after('nombre');

        $table->string('apellido_materno')->after('apellido_paterno');

        $table->string('curp')->unique()->after('apellido_materno');

        $table->string('genero')->after('rfc');

        $table->string('gmail')->unique()->after('genero');

    });
}

    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('docentes', function (Blueprint $table) {

        $table->dropColumn([
            'apellido_paterno',
            'apellido_materno',
            'curp',
            'genero',
            'gmail'
        ]);

    });
}
};
