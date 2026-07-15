<?php

namespace App\Http\Controllers\Profesor;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use App\Models\Nota;
use Illuminate\Support\Facades\Auth;

class ProfesorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        // Notas recientes para el dashboard
        $notasRecientes = Nota::where('teacher_id', $teacher->id)
                              ->latest('created_at')
                              ->take(5)
                              ->with('student') 
                              ->get();

        // PASA AMBAS VARIABLES A LA VISTA
        return view('profesor.index', compact('notasRecientes'));
    }

    public function materiasAsignadas()
    {
        $teacher = Auth::user()->teacher;

        // Materias para tu acordeón o listado
        $materias = $teacher->materias()->withCount('students')->get();

        return view('profesor.materias.index', compact('materias'));
    }

    public function alumnosPorMateria($id) {
        $teacher = Auth::user()->teacher;

        $materias = $teacher->materias()->get();

        // 1. Cargamos los estudiantes junto con sus notas
        $materiaSeleccionada = $teacher->materias()
            ->with(['students' => function($query) use ($id, $teacher) {
                // Cargamos las notas de cada estudiante, pero filtradas por esta materia y este profesor
                $query->with(['notas' => function($q) use ($id, $teacher) {
                    $q->where('materia_id', $id)
                    ->where('teacher_id', $teacher->id);
                }]);
            }])
            ->findOrFail($id);

        // 2. Calculamos el promedio antes de enviar a la vista
        foreach ($materiaSeleccionada->students as $student) {
            // Obtenemos la colección de notas filtradas
            $notas = $student->notas;
            
            // Calculamos el promedio
            $student->promedio = $notas->count() > 0 
                ? $notas->avg('valor_nota') 
                : 0;
        }

        return view('profesor.alumnos.index', compact('materias', 'materiaSeleccionada'));
    }
}