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

        $materiaSeleccionada = $teacher->materias()
            ->with(['students' => function($query) use ($id, $teacher) {
                $query->with(['notas' => function($q) use ($id, $teacher) {
                    $q->where('materia_id', $id)
                    ->where('teacher_id', $teacher->id);
                }]);
            }])
            ->findOrFail($id);

        // Recalcular y asegurar que el promedio exista en la pivote para cada alumno
        foreach ($materiaSeleccionada->students as $student) {
            $notas = $student->notas;
            $promedioFinal = $notas->count() > 0 ? $notas->avg('valor_nota') : 0;
            $promedioFinal = (float) round($promedioFinal, 2);

            // Actualizamos o sincronizamos la tabla pivote de una vez
            \Illuminate\Support\Facades\DB::table('materia_student')
                ->updateOrInsert(
                    ['materia_id' => $id, 'student_id' => $student->id],
                    ['promedio' => $promedioFinal]
                );
                
            // Asignamos el valor al pivot para que la vista lo lea sin problemas
            $student->pivot->promedio = $promedioFinal;
        }

        return view('profesor.alumnos.index', compact('materias', 'materiaSeleccionada'));
    }
}