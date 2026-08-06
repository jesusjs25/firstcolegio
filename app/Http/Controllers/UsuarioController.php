<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;

use App\Traits\ActivityLogger;

class UsuarioController extends Controller
{
    use ActivityLogger;
    /**
     * Despliega una lista de usuarios.
     */
    public function index()
    {
        $usuarios = User::paginate(20);
        // $usuarios = User::all();

        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Almacenar el usuario nuevo.
     */
    public function store(StoreUserRequest $request)
    {
    // Usamos una transacción para que no se cree el usuario si falla el perfil
        DB::transaction(function () use ($request) {
        
        // 1. Crear el usuario base con los datos validados
        $usuario = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
        ]);

        // 2. Asignar el rol (si usas Spatie)
        if (method_exists($usuario, 'assignRole')) {
            $usuario->assignRole($request->role);
        }

        // 3. Crear el perfil extra según el rol
        if ($request->role === 'Alumno') {
            Student::create([
                'user_id'    => $usuario->id,
                'document'   => $request->document,
                'birth_date' => $request->birth_date,
            ]);
        } elseif ($request->role === 'Profesor') {
            $specialties = is_array($request->specialty)
                ? implode(',', $request->specialty)
                : $request->specialty;
        
            Teacher::create([
                'user_id'   => $usuario->id,
                'specialty' => $specialties,
            ]);
        }

        $this->logActivity('creó', 'Usuario', $usuario->name);
    });

    return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado exitosamente');
    }

    // Mostrar los detalles de un usuario específico

    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    // Mostrar el formulario de edición para un usuario específico

    public function edit($id)
    {
        $usuario = User::with(['student', 'teacher'])->findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    // Método para actualizar un usuario específico
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$usuario->id,
            'document' => 'required_if:role,Alumno|nullable|string|max:20',
            'birth_date' => 'required_if:role,Alumno|nullable|date',
            'specialties' => 'required_if:role,Profesor|nullable|array',
            'role' => 'required|in:Admin,Profesor,Alumno',
        ]);
        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->role === 'Alumno') {
        $usuario->student()->updateOrCreate(
            ['user_id' => $usuario->id],
            [
                'document'   => $request->document,
                'birth_date' => $request->birth_date,
            ]
        );
        // Si tenía registro de profesor previa/e, opcionalmente se limpia
        if ($usuario->teacher) { $usuario->teacher()->delete(); }

    } elseif ($request->role === 'Profesor') {
        $usuario->teacher()->updateOrCreate(
            ['user_id' => $usuario->id],
            [
                'specialties' => $request->specialties, // Si es un campo JSON en BD o relación pivot
            ]
        );
        if ($usuario->student) { $usuario->student()->delete(); }

    } else {
        // Si es Admin, elimina datos específicos de los otros roles si existían
        if ($usuario->student) { $usuario->student()->delete(); }
        if ($usuario->teacher) { $usuario->teacher()->delete(); }
    }

    $usuario->syncRoles([$request->role]);
    $this->logActivity('actualizó', 'Usuario', $usuario->name);

    return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }
    public function destroy($id)
{
    $usuario = User::findOrFail($id);

    // Si tiene datos asociados en tablas secundarias, puedes eliminarlos antes o dejar que la foreign key en cascada lo haga
    if ($usuario->student) {
        $usuario->student()->delete();
    }

    if ($usuario->teacher) {
        $usuario->teacher()->delete();
    }

    // Registrar la actividad (si utilizas un logger interno)
    if (method_exists($this, 'logActivity')) {
        $this->logActivity('eliminó', 'Usuario', $usuario->name);
    }

    $usuario->delete();

    return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
