@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2>Crear Nuevo Usuario</h2>
    <form action="{{ route('usuarios.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Rol</label>
            <select name="rol" class="form-control">
                <option value="admin">Administrador</option>
                <option value="profe">Profesor</option>
                <option value="estudiante">Estudiante</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar Usuario</button>
    </form>
</div>
@endsection