<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('docentes', function (Blueprint $table) {
            if (!Schema::hasColumn('docentes', 'rol')) {
                $table->string('rol')->default('Docente');
            }
            if (!Schema::hasColumn('docentes', 'departamento')) {
                $table->string('departamento')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->dropColumn(['rol', 'departamento']);
        });
    }
};