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
        Schema::table('materia_teacher', function (Blueprint $table) {
            //
            $table->string('horario')->nullable()->after('materia_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materia_teacher', function (Blueprint $table) {
            //
            $table->dropColumn('horario');
        });
    }
};
