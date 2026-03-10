@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb-4">
        <h2>Gestión de Materias</h2>
        <button class="btn btn-primary">Nueva Materia</button>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Profesores Asignados</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- Aquí iterarás las materias luego --}}
        </tbody>
    </table>
</div>
@endsection