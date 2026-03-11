@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Panel de Administración</h1>

    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body d-flex flex-column">
                    <h6 class="text-xs font-weight-bold text-primary text-uppercase mb-1">Estudiantes</h6>
                    <p class="h5 mb-2 font-weight-bold text-gray-800">0</p>
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-primary btn-sm mt-auto">Ver Usuarios</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body d-flex flex-column">
                    <h6 class="text-xs font-weight-bold text-success text-uppercase mb-1">Materias</h6>
                    <p class="h5 mb-2 font-weight-bold text-gray-800">0</p>
                    <a href="{{ route('admin.materias.index') }}" class="btn btn-success btn-sm mt-auto">Ver Materias</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body d-flex flex-column">
                    <h6 class="text-xs font-weight-bold text-info text-uppercase mb-1">Profesores</h6>
                    <p class="h5 mb-2 font-weight-bold text-gray-800">0</p>
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-info btn-sm mt-auto">Ver Profesores</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body d-flex flex-column">
                    <h6 class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cursos</h6>
                    <p class="h5 mb-2 font-weight-bold text-gray-800">0</p>
                    <a href="{{ route('admin.materias.index') }}" class="btn btn-warning btn-sm mt-auto">Ver Cursos</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary w-100">Crear Nuevo Usuario</a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="{{ route('admin.materias.create') }}" class="btn btn-success w-100">Crear Nueva Materia</a>
        </div>
    </div>
</div>
@endsection