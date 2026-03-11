@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb-4">
        <h2>Gestión de Materias</h2>
        <a href="{{ route('admin.materias.create') }}" class="btn btn-primary">Nueva Materia</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($materias as $materia)
                <tr>
                    <td>{{ $materia->nombre }}</td>
                    <td>{{ $materia->descripcion }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('admin.materias.destroy', $materia->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No hay materias registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection