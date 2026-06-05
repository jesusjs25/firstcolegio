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
        Schema::table('materia_student', function (Blueprint $table) {
            //Agregar teacher_id a la tabla materia_student
            $table->foreignId('teacher_id')->constrained('teachers')->after('materia_id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materia_student', function (Blueprint $table) {
            //Eliminar teacher_id de la tabla materia_student
            $table->dropForeign(['teacher_id']);
            $table->dropColumn('teacher_id');
        });
    }
};
