<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Profesor\ProfesorController;
use Illuminate\Http\Request;

// --- RUTAS PÚBLICAS ---
Route::get('/', function () {
    return view('welcome');
});

// --- RUTAS PROTEGIDAS (REQUIEREN LOGIN) ---
Route::middleware(['auth', 'verified'])->group(function () {

    /**
     * REDIRECCIÓN INICIAL
     * En lugar de un 'dashboard' genérico, esta ruta redirige al usuario
     * a su panel correspondiente según su rol apenas inicia sesión.
     */
    Route::get('/dashboard', function (Request $request) {
        $user = $request->user();
        
        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.index');
        } elseif ($user->hasRole('Profesor')) {
            return redirect()->route('profesor.index');
        } elseif ($user->hasRole('Alumno')) {
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

        Route::resource('materias', MateriaController::class);                  // admin/materias
        Route::resource('usuarios', UsuarioController::class);                  // admin/usuarios
    });

    // ==========================================
    // SECCIÓN PROFESOR
    // ==========================================
    Route::middleware(['role:Profesor'])->prefix('profesor')->group(function () {
        Route::get('/', function () {                                           // profesor/index
            return view('profesor.index'); 
        })->name('profesor.index');
                Route::get('/materias-asignadas', [ProfesorController::class, 'index'])->name('profesor.materias.index');    // profesor/materias-asignadas
                Route::get('/alumnos-por-materia/{id}', [ProfesorController::class, 'alumnosPorMateria'])->name('alumnos.index');   // profesor/alumnos-por-materia/{id}
                Route::get('/gestionar-notas', function () {                    // profesor/promedios
                    return view('profesor.notas.index'); 
                })->name('profesor.notas.index');

    });

    // ==========================================
    // SECCIÓN ALUMNO
    // ==========================================
    Route::middleware(['role:Alumno'])->prefix('alumno')->group(function () {
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
/*
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');
    
    // Otras rutas de administración aquí

    Route::resource('materias', MateriaController::class)->middleware('auth');

    Route::resource('usuarios', UsuarioController::class)->middleware('auth');
});

require __DIR__.'/auth.php';*/

