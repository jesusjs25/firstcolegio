<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Materia;
use App\Models\teacher;
use App\Models\student;
use Illuminate\Http\Request;
use App\Traits\ActivityLogger;
class MateriaController extends Controller
{
    use ActivityLogger; // Incluimos el trait para registrar actividades

public function index()
{
    $materias = Materia::all();
    return view('admin.materias.index', compact('materias'));
}

public function create()
{
    // Buscamos usuarios que tengan asignado el nombre del rol tal cual sale en la BD
    $profesores = User::role('Profesor')->get();
    $estudiantes = User::role('Alumno')->get();

    return view('admin.materias.create', compact('profesores', 'estudiantes'));
}


// Método para almacenar una nueva materia
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'teacher_id' => 'required|exists:users,id',
        'estudiantes' => 'nullable|array',
        'estudiantes.*' => 'exists:users,id',
    ]);

    $materia = Materia::create([
        'nombre' => $request->name,
        'descripcion' => $request->description,
        'teachers_id' => $request->teacher_id,
    ]);

    if ($request->has('estudiantes')) {
        $materia->estudiantes()->sync($request->estudiantes);
    }

    $this->logActivity('creó', 'Materia', "Materia {$materia->nombre} creada");

    return redirect()->route('admin.materias.index')->with('success', 'Materia creada exitosamente.');
}


// Método para mostrar los detalles de una materia específica
public function show(Materia $materia)
{
    return view('materias.show', compact('materia'));
}


// Método para mostrar el formulario de edición de una materia específica
public function edit(Materia $materia)
{
    return view('admin.materias.edit', compact('materia'));
}


// Método para actualizar una materia específica
public function update(Request $request, Materia $materia)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'teacher_id' => 'required|exists:users,id',
        'estudiantes' => 'array',
        'estudiantes.*' => 'exists:users,id',
    ]);

    $materia->update([
        'nombre' => $request->name,
        'descripcion' => $request->description,
        'teachers_id' => $request->teacher_id,
    ]);

    if ($request->has('estudiantes')) {
        $materia->estudiantes()->sync($request->estudiantes);
    }

    $this->logActivity('editó', 'Materia', "Materia {$materia->nombre} editada");

    return redirect()->route('materias.index')->with('success', 'Materia actualizada exitosamente.');
}


// Método para eliminar una materia específica
public function destroy(Materia $materia)
{
    $this->logActivity('eliminó', 'Materia', "Materia {$materia->nombre} eliminada");

    $materia->delete();

    return redirect()->route('admin.materias.index')->with('success', 'Materia eliminada exitosamente.');
}
}