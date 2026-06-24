<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Materia;
use App\Models\Teacher;
use App\Models\Student;
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
    $profesores = Teacher::with('user')->get();
    $estudiantes = Student::with('user')->get();

    return view('admin.materias.create', compact('profesores', 'estudiantes'));
}


// Método para almacenar una nueva materia
public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'teacher_id' => 'required|exists:teachers,id',
    ]);

    $materia = Materia::create([
        'nombre' => $request->input('nombre'),
        'descripcion' => $request->input('descripcion'),
    ]);

    if ($request->has('teacher_id')) {
        $materia->teachers()->attach($request->teacher_id);
    }

    if ($request->has('estudiantes')) {
        // 1. Capturamos el profesor seleccionado en el formulario
    $teacherId = $request->input('teacher_id');

    // 2. Armamos el arreglo asociando cada ID de estudiante con su respectivo profesor
    $estudiantesData = [];
    foreach ($request->input('estudiantes') as $studentId) {
        $estudiantesData[$studentId] = [
            'teacher_id' => $teacherId
        ];
    }

    // 3. Pasamos el array completo con los datos de la tabla pivot incluidos
        $materia->students()->attach($estudiantesData);
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
    // Carga las relaciones exactas de tu modelo
    $materia->load(['teachers.user', 'students']);

    // Listas para los selectores del formulario
    $profesores = Teacher::with('user')->get();
    
    // Como tu relación apunta a User::class, listamos los usuarios con rol estudiante
    $estudiantes = Student::with('user')->get(); 

    return view('admin.materias.edit', compact('materia', 'profesores', 'estudiantes'));
}


// Método para actualizar una materia específica
public function update(Request $request, Materia $materia)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'teacher_id' => 'required|exists:users,id',
        'estudiantes' => 'required|array',
    ]);

    $materia->update([
        'nombre' => $request->input('nombre'),
        'descripcion' => $request->input('descripcion'),
    ]);

    $materia->teachers()->sync($request->teacher_id);

    $teacherId = $request->input('teacher_id');
    $estudiantesData = [];

    foreach ($request->input('estudiantes') as $studentId) {
        $estudiantesData[$studentId] = [
            'teacher_id' => $teacherId
        ];
    }
        $materia->students()->sync($estudiantesData);

    $this->logActivity('actualizó', 'Materia', "Materia {$materia->nombre} actualizada");

    return redirect()->route('admin.materias.index')->with('success', 'Materia actualizada exitosamente.');
}


// Método para eliminar una materia específica
public function destroy(Materia $materia)
{
    $this->logActivity('eliminó', 'Materia', "Materia {$materia->nombre} eliminada");

    $materia->delete();

    return redirect()->route('admin.materias.index')->with('success', 'Materia eliminada exitosamente.');
}
}