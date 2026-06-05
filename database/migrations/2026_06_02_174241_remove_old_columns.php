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
        //Borrar las columnas que ya no se necesitan
        //Tabla users
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rol');
        });

        //Tabla materias
        Schema::table('materias', function (Blueprint $table) {
            $table->dropColumn('teacher_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Revertir los cambios: volver a agregar las columnas que eliminamos
        //Tabla users
        Schema::table('users', function (Blueprint $table) {
            $table->string('rol')->after('password');
        });

        //Tabla materias
        Schema::table('materias', function (Blueprint $table) {
            $table->foreignId('teacher_id')->constrained('teachers')->after('name')->onDelete('cascade');
        });
    }
};
