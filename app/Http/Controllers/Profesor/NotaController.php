<?php

namespace App\Http\Controllers\Profesor;

use App\Http\Controllers\Controller;
use App\Models\Nota;
use App\Models\Student;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    // Guardar nueva nota con límite dinámico y tope máximo de 4 puntos
    public function store(Request $request) {
        $request->validate([
            'materia_id'    => 'required|exists:materias,id',
            'student_id'    => 'required|exists:students,id',
            'nombre_nota'   => 'required|string', 
            'puntaje_maximo'=> 'required|integer|min:0|max:4', // El profesor define cuánto vale en total, máximo 4 puntos
            'valor_nota'    => 'required|numeric|min:0', 
            'fecha_nota'    => 'required|date|before_or_equal:today',    
        ]);

        // 1. Validar que el valor de la nota no sea mayor al puntaje total configurado para esa evaluación
        if ($request->valor_nota > $request->puntaje_maximo) {
            return back()->withErrors(['valor_nota' => "La nota ({$request->valor_nota}) no puede ser mayor al valor total de la evaluación ({$request->puntaje_maximo} puntos)."])->withInput();
        }

        // 2. Opcional: Validar que la suma acumulada de notas para este mismo tipo de evaluación no supere el puntaje máximo
        $acumuladoActual = \App\Models\Nota::where('materia_id', $request->materia_id)
            ->where('student_id', $request->student_id)
            ->where('nombre_nota', $request->nombre_nota)
            ->sum('valor_nota');

        if (($acumuladoActual + $request->valor_nota) > $request->puntaje_maximo) {
            return back()->withErrors(['valor_nota' => "El límite total para esta evaluación es de {$request->puntaje_maximo} puntos. Ya lleva acumulado {$acumuladoActual}."])->withInput();
        }

        \App\Models\Nota::create([
            'materia_id'    => $request->materia_id,
            'student_id'    => $request->student_id,
            'teacher_id'    => Auth::user()->teacher->id,
            'nombre_nota'   => $request->nombre_nota, 
            'puntaje_maximo'=> $request->puntaje_maximo, // Guardamos el valor total de la evaluación
            'valor_nota'    => $request->valor_nota,   
            'fecha_nota'    => $request->fecha_nota,   
        ]);

        return back()->with('success', 'Nota registrada correctamente.');
    }

    // Actualizar (Editar)
    // Actualizar (Editar) con validación de límite
    public function update(Request $request, $materiaId, $studentId, $id) {
        $request->validate([
            'nombre_nota'   => 'required|string',
            'puntaje_maximo'=> 'required|integer|min:0|max:4', // El profesor define el total, máximo 4 puntos
            'valor_nota'    => 'required|numeric|min:0',
            'fecha_nota'    => 'required|date|before_or_equal:today',
        ]);

        // 1. Validar que el valor de la nota no sea mayor al puntaje total configurado
        if ($request->valor_nota > $request->puntaje_maximo) {
            return back()->withErrors(['valor_nota' => "La nota ({$request->valor_nota}) no puede ser mayor al valor total de la evaluación ({$request->puntaje_maximo} puntos)."])->withInput();
        }

        $nota = Nota::where('id', $id)
                    ->where('materia_id', $materiaId)
                    ->where('student_id', $studentId)
                    ->firstOrFail();

        // 2. Validar acumulado excluyendo la nota actual que se está editando
        $acumuladoActual = \App\Models\Nota::where('materia_id', $materiaId)
            ->where('student_id', $studentId)
            ->where('nombre_nota', $request->nombre_nota)
            ->where('id', '!=', $id) // Excluimos esta nota para que no se sume a sí misma al editar
            ->sum('valor_nota');

        if (($acumuladoActual + $request->valor_nota) > $request->puntaje_maximo) {
            return back()->withErrors(['valor_nota' => "El límite total para esta evaluación es de {$request->puntaje_maximo} puntos. Ya lleva acumulado {$acumuladoActual} en otras notas de esta misma evaluación."])->withInput();
        }

        // Actualizamos los campos incluyendo el puntaje máximo
        $nota->update($request->only(['nombre_nota', 'puntaje_maximo', 'valor_nota', 'fecha_nota']));

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