@extends('layouts.materias')
    
@section('content')
<div class="container mt-4">
    <h2>Editar Materia</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.materias.update', $materia) }}" method="POST">
        @csrf
        @method('PUT') <div class="form-group mb-3">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $materia->nombre) }}" required>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Curso</label>
        <select name="curso" class="form-select" id="curso" required>
            <option value="">Seleccione un curso</option>
            <option value="1er año">1er año</option>
            <option value="2do año">2do año</option>
            <option value="3er año">3er año</option>
            <option value="4to año">4to año</option>
            <option value="5to año">5to año</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="descripcion">Descripción</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion', $materia->descripcion) }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="teacher_id">Profesor</label>
        <select name="teacher_id" id="teacher_id" class="form-select" required>
            <option value="">Seleccione un profesor</option>
            @foreach($profesores as $profesor)
                <option value="{{ $profesor->id }}" 
                    {{ $materia->teachers->contains('id', $profesor->id) ? 'selected' : '' }}>
                    {{ $profesor->user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Horario</label>
        <select name="horario" class="form-select" id="horario" required>
            <option value="">Seleccione un horario</option>
            <option value="7:00-8:20">7:00-8:20</option>
            <option value="8:20-9:40">8:20-9:40</option>
            <option value="10:00-11:20">10:00-11:20</option>
            <option value="11:20-12:30">11:20-12:30</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="estudiantes">Estudiantes</label>
        <select name="estudiantes[]" id="estudiantes" class="form-select" multiple required>
            @foreach($estudiantes as $estudiante)
                <option value="{{ $estudiante->id }}" 
                    {{ $materia->students->contains('id', $estudiante->id) ? 'selected' : '' }}>
                    {{ $estudiante->user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('admin.materias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    </div>
@endsection
