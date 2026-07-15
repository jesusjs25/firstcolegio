<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Obtener IDs de alumnos directamente de tu tabla 'students'
        $alumnoIds = [];
        if (Schema::hasTable('students')) {
            $alumnoIds = DB::table('students')->pluck('id')->toArray(); 
        } elseif (Schema::hasTable('users')) {
            $alumnoIds = DB::table('users')->pluck('id')->toArray(); 
        }

        // 2. Obtener IDs de materias reales
        $materiaIds = DB::table('materias')->pluck('id')->toArray();

        // 3. Obtener IDs de profesores de forma segura en 'teachers'
        $docenteIds = [];
        if (Schema::hasTable('teachers')) {
            $docenteIds = DB::table('teachers')->pluck('id')->toArray();
        } elseif (Schema::hasTable('profesores')) {
            $docenteIds = DB::table('profesores')->pluck('id')->toArray();
        }

        // Validaciones preventivas para evitar que corra vacío
        if (empty($alumnoIds)) {
            $this->command->warn("¡Alerta! Tu tabla 'students' está vacía. Registra al menos un estudiante antes de sembrar notas.");
            return;
        }
        if (empty($materiaIds)) {
            $this->command->warn("¡Alerta! Tu tabla 'materias' está vacía. Registra al menos una materia antes de sembrar notas.");
            return;
        }

        // 4. Limpiamos la tabla de notas evitando problemas de Foreign Keys
        Schema::disableForeignKeyConstraints();
        DB::table('notas')->truncate();
        Schema::enableForeignKeyConstraints();

        $evaluaciones = ['Parcial I', 'Parcial II', 'Taller Práctico', 'Examen Final', 'Exposición'];
        $datos = [];

        // 5. Sembrar 150 registros con fechas distribuidas en los últimos 3 meses
        for ($i = 1; $i <= 150; $i++) {
            $nota = rand(5, 20); 
            $fechaAleatoria = Carbon::now()->subDays(rand(1, 90));

            $datos[] = [
                'student_id'  => $alumnoIds[array_rand($alumnoIds)],
                'materia_id'  => $materiaIds[array_rand($materiaIds)],
                'teacher_id'  => !empty($docenteIds) ? $docenteIds[array_rand($docenteIds)] : null,
                'nombre_nota' => $evaluaciones[array_rand($evaluaciones)],
                'valor_nota'  => $nota,
                'fecha_nota'  => $fechaAleatoria->format('Y-m-d'),
                'created_at'  => $fechaAleatoria,
                'updated_at'  => $fechaAleatoria,
            ];
        }

        DB::table('notas')->insert($datos);
        $this->command->info("¡Sembrado completado exitosamente! Se crearon 150 notas enlazadas a tus alumnos reales.");
    }
}