<?php

namespace App\Http\Controllers;

use App\Models\Materia;
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
    return view('admin.materias.create');
}  

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50|unique:materias',
    ]);

    Materia::create($request->all());

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
        'code' => 'required|string|max:50|unique:materias,code,' . $materia->id,
    ]);

    $materia->update($request->all());

    return redirect()->route('materias.index')->with('success', 'Materia actualizada exitosamente.');
}

public function destroy(Materia $materia)
{
    $materia->delete();

    return redirect()->route('materias.index')->with('success', 'Materia eliminada exitosamente.');
}
}