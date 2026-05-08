<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->string('instructor')->nullable()->after('hora_fin');
            $table->string('co_instructor')->nullable()->after('instructor');
        });
    }

    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropColumn(['instructor', 'co_instructor']);
        });
    }
};