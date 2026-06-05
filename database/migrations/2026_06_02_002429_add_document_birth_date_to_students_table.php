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
        Schema::table('students', function (Blueprint $table) {
            //Eliminar las columnas que no van
            $table->dropColumn(['name', 'email']);

            //Agregar las nuevas
            $table->string('document')->after('user_id')->unique();
            $table->date('birth_date')->after('document');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //Revertir: volver a agregar las columnas que quitamos
            $table->string('name')->after('user_id');
            $table->string('email')->unique()->after('name');

            //Quitar lo que agregamos
            $table->dropColumn(['document', 'birth_date']);
        });
    }
};
