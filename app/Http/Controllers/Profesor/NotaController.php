<?php

namespace App\Http\Controllers\Profesor;

use App\Http\Controllers\Controller;
use App\Models\Nota;
use App\Models\Student;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotaController extends Controller
{
    // Mostrar el formulario y el listado de notas de una materia
    public function index($materiaId, $studentId) {
        $materia = \App\Models\Materia::findOrFail($materiaId);
        $student = \App\Models\Student::with('user')->findOrFail($studentId);
        
        // Filtramos SOLO las notas de este alumno en esta materia
        $notas = \App\Models\Nota::where('materia_id', $materiaId)
                                ->where('student_id', $studentId)
                                ->where('teacher_id', \Illuminate\Support\Facades\Auth::user()->teacher->id)
                                ->get();

        return view('profesor.notas.index', compact('materia', 'student', 'notas'));
    }

    // Guardar nueva nota (Sección 1)
    public function store(Request $request) {
        $request->validate([
            'materia_id'  => 'required|exists:materias,id',
            'student_id'  => 'required|exists:students,id',
            'nombre_nota' => 'required|string', // Cambiado
            'valor_nota'  => 'required|numeric', // Cambiado
            'fecha_nota'  => 'required|date',    // Cambiado
        ]);

        
        \App\Models\Nota::create([
            'materia_id'  => $request->materia_id,
            'student_id'  => $request->student_id,
            'teacher_id'  => Auth::user()->teacher->id,
            'nombre_nota' => $request->nombre_nota, // Usamos el nombre real
            'valor_nota'  => $request->valor_nota,   // Usamos el nombre real
            'fecha_nota'  => $request->fecha_nota,   // Usamos el nombre real
        ]);

        return back()->with('success', 'Nota registrada correctamente.');
    }

    // Actualizar (Editar)
    public function update(Request $request, $materiaId, $studentId, $id) {
        $request->validate([
            'nombre_nota' => 'required|string',
            'valor_nota'  => 'required|numeric',
            'fecha_nota'  => 'required|date',
        ]);

        $nota = Nota::where('id', $id)
                    ->where('materia_id', $materiaId)
                    ->where('student_id', $studentId)
                    ->firstOrFail();

        $nota->update($request->only(['nombre_nota', 'valor_nota', 'fecha_nota']));

        return back()->with('success', 'Nota actualizada correctamente.');
    }

    // Eliminar
        public function destroy($materia, $student, $id) {
        // Opcional pero recomendado: buscar la nota validando que pertenezca 
        // a esa materia y ese alumno, para mayor seguridad.
        $nota = Nota::where('id', $id)
                    ->where('materia_id', $materia)
                    ->where('student_id', $student)
                    ->firstOrFail();

        $nota->delete();

        return back()->with('success', 'Nota eliminada.');
    }
}