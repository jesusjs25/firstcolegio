<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Materia;
use App\Models\teacher;
use App\Models\student;
use Illuminate\Http\Request;
class MateriaController extends Controller
{


public function index()
{
    $materias = Materia::all();
    return view('admin.materias.index', compact('materias'));
}

public function create()
{
    // Buscamos usuarios que tengan asignado el nombre del rol tal cual sale en tu BD
    $profesores = User::role('Profesor')->get();
    $estudiantes = User::role('Alumno')->get();

    return view('admin.materias.create', compact('profesores', 'estudiantes'));
}

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

    return redirect()->route('materias.index')->with('success', 'Materia creada exitosamente.');
}

public function show(Materia $materia)
{
    return view('materias.show', compact('materia'));
}

public function edit(Materia $materia)
{
    return view('materias.edit', compact('materia'));
}

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

    return redirect()->route('materias.index')->with('success', 'Materia actualizada exitosamente.');
}

public function destroy(Materia $materia)
{
    $materia->delete();

    return redirect()->route('materias.index')->with('success', 'Materia eliminada exitosamente.');
}
}