@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Crear Nueva Materia</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.materias.store') }}" method="POST">
                @csrf
                
                {{-- Campo: Nombre --}}
                <div class="form-group mb-3">
                    <label for="nombre">Nombre de la Materia</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Ej. Programación I" required>
                </div>

                {{-- Campo: Descripción --}}
                <div class="form-group mb-3">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Breve descripción de la materia..."></textarea>
                </div>

                {{-- Campo: Asignar profesores (Multi-select) --}}
                <div class="form-group mb-4">
                    <label for="profesores">Asignar profesores (Multi-select)</label>
                    <select name="profesores[]" class="form-control" multiple required>
                        <option value="1">Prof. Juan Pérez</option>
                        <option value="2">Prof. Maria Lopez</option>
                        <option value="3">Prof. Carlos Rodriguez</option>
                    </select>
                    <small class="text-muted">Usa Ctrl + Click para seleccionar varios profesores.</small>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('materias.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar Materia</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection