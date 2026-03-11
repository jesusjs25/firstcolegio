@extends('layouts.admin') 

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gestión de Usuarios</h2>
        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary">Crear Nuevo Usuario</a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Angelito</td>
            <td>angelito@gmail.com</td>
            <td>Administrador</td>
            <td>Activo</td>
            <td>
                <button class="btn btn-warning">Editar</button>
                <button class="btn btn-danger">Desactivar</button>
            </td>
        </tr>
    </tbody>
</table>
        </div>
    </div>
</div>
@endsection