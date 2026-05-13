<?php

namespace App\Http\Controllers\Profesor;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use Illuminate\Support\Facades\Auth;

class ProfesorController extends Controller
{
    /**
     * Muestra la lista de materias asignadas al profesor logueado.
     */
    public function index()
    {
        // 1. Obtenemos el ID del profesor con la sesión activa
        $teacherId = Auth::id();

        // 2. Consultamos las materias filtrando por teachers_id
        // Usamos withCount('estudiantes') para obtener el total de alumnos
        // vinculados en la tabla pivot Materia_student
        $materias = Materia::where('teachers_id', $teacherId)
            ->withCount('estudiantes') 
            ->get();

        // 3. Retornamos la vista con la colección de materias
        return view('profesor.materias.index', compact('materias'));
    }

    public function alumnosPorMateria($id){
        $teacherId = Auth::id();
        
        // Obtenemos todas las materias para los acordeones
        $materias = Materia::where('teachers_id', $teacherId)->get();

        // Buscamos la materia seleccionada o lanzamos error 404 si no existe
        $materiaSeleccionada = Materia::where('teachers_id', $teacherId)
            ->with('estudiantes')
            ->findOrFail($id);

        return view('profesor.alumnos.index', compact('materias', 'materiaSeleccionada'));
    }
}