<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear los roles (asegúrate de tener instalado Spatie)
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $roleProfesor = Role::firstOrCreate(['name' => 'Profesor']);
        $roleAlumno = Role::firstOrCreate(['name' => 'Alumno']);

        $userAdmin = User::firstOrCreate([
            'email' => 'hola@gmail.com',
        ], [
            'name' => 'yo',
            'password' => bcrypt('12345678'),
        ]);
        $userAdmin->assignRole($roleAdmin);

        // 2. Crear el Profesor de prueba
        $userProfesor = User::firstOrCreate([
            'email' => 'juan@gmail.com',
        ], [
            'name' => 'Juan',
            'password' => bcrypt('12345678'),
        ]);
        $userProfesor->assignRole($roleProfesor);

        // 3. Crear el Alumno de prueba
        $userAlumno = User::firstOrCreate([
            'email' => 'angelo@gmail.com',
        ], [
            'name' => 'Angelo',
            'password' => bcrypt('12345678'),
        ]);
        
        $userAlumno->assignRole($roleAlumno);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
