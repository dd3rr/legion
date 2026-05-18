<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('docentes', function (Blueprint $table) {
            if (!Schema::hasColumn('docentes', 'carrera')) {
                $table->string('carrera')->nullable();
            }
            if (!Schema::hasColumn('docentes', 'especialidad')) {
                $table->string('especialidad')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->dropColumn(['carrera', 'especialidad']);
        });
    }
};