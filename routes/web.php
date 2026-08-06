<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\Profesor\ProfesorController;
use App\Http\Controllers\Profesor\NotaController;
use Illuminate\Http\Request;

Route::redirect('/', '/dashboard'); // Redirige la raíz al dashboard (que luego redirige según rol)

// --- RUTAS PROTEGIDAS (REQUIEREN LOGIN) ---
Route::middleware(['auth', 'verified'])->group(function () {

    /**
     * REDIRECCIÓN INICIAL
     * En lugar de un 'dashboard' genérico, esta ruta redirige al usuario
     * a su panel correspondiente según su rol apenas inicia sesión.
     */
    Route::get('/dashboard', function (Request $request) {
        $user = $request->user();
        
        if ($user->role === 'Admin') {
            return redirect()->route('admin.index');
        } elseif ($user->role === 'Profesor') {
            return redirect()->route('profesor.index');
        } elseif ($user->role === 'Alumno') {
            return redirect()->route('alumno.index');
        }

        return redirect('/'); // Por si no tiene rol asignado
    })->name('dashboard');

    // Perfil de usuario (común para todos)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==========================================
    // SECCIÓN ADMINISTRADOR
    // ==========================================
    Route::middleware(['role:Admin'])->prefix('admin')->group(function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');

        Route::resource('materias', MateriaController::class);                // admin/materias
        Route::resource('usuarios', UsuarioController::class);                // admin/usuarios
        Route::resource('reportes', ReporteController::class);                // admin/reportes
        Route::resource('historial', HistorialController::class);             // admin/historial
        Route::get('/admin/reportes/exportar', [ReporteController::class, 'exportarExcel'])->name('admin.reportes.exportar');
    });

    // ==========================================
    // SECCIÓN PROFESOR
    // ==========================================
    Route::middleware(['role:Profesor'])->prefix('profesor')->group(function () {
        Route::get('/', [ProfesorController::class, 'index'])->name('profesor.index');
        Route::get('/materias-asignadas', [ProfesorController::class, 'materiasAsignadas'])->name('profesor.materias.index');    // profesor/materias-asignadas
        Route::get('/alumnos-por-materia/{id}', [ProfesorController::class, 'alumnosPorMateria'])->name('alumnos.index');   // profesor/alumnos-por-materia/{id}
        Route::get('/notas/{materia}/{student}', [NotaController::class, 'index'])->name('profesor.notas.index');                 //gestionar notas
        Route::post('/notas/{materia}/{student}', [NotaController::class, 'store'])->name('profesor.notas.store');                 //guardar notas
        Route::put('/notas/{materia}/{student}/{id}', [NotaController::class, 'update'])->name('profesor.notas.update');            //actualizar notas
        Route::delete('/notas/{materia}/{student}/{id}', [NotaController::class, 'destroy'])->name('profesor.notas.destroy');          //eliminar notas

    });

    // ==========================================
    // SECCIÓN ALUMNO
    // ==========================================
    Route::middleware(['auth'])->prefix('alumno')->group(function () { 
        Route::get('/', function () {
            // Asegúrate de crear esta vista en resources/views/alumno/index.blade.php
            return view('alumno.index'); 
        })->name('alumno.index');
    });
        // Esto crea index, create, store, show, edit, update y destroy de un solo golpe
        Route::resource('admin/usuarios', UsuarioController::class)->names('admin.usuarios');
        Route::resource('admin/materias', MateriaController::class)->names('admin.materias');
});

require __DIR__.'/auth.php';
