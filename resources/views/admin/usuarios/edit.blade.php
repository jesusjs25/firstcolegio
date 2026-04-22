@extends('layouts.usuarios')

@section('content')
<div class="container mt-4">
    <h2>Editar Usuario</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Rol</label>
            <select class="form-select" id="role" name="role" required>
                <option value="">Seleccione un rol</option>
                <option value="Admin" {{ $usuario->hasRole('Admin') ? 'selected' : '' }}>Administrador</option>
                <option value="Profesor" {{ $usuario->hasRole('Profesor') ? 'selected' : '' }}>Profesor</option>
                <option value="Alumno" {{ $usuario->hasRole('Alumno') ? 'selected' : '' }}>Alumno</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
