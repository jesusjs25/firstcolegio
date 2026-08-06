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
            <label for="role" class="form-label">Rol</label>
            <select class="form-select" id="role" name="role" required>
                <option value="">Seleccione un rol</option>
                <option value="Admin" {{ $usuario->hasRole('Admin') ? 'selected' : '' }}>Administrador</option>
                <option value="Profesor" {{ $usuario->hasRole('Profesor') ? 'selected' : '' }}>Profesor</option>
                <option value="Alumno" {{ $usuario->hasRole('Alumno') ? 'selected' : '' }}>Alumno</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
        </div>

    <div id="campos-alumno">
        <!-- Documento de Identidad -->
        <div class="form-group mb-3" id="campo-documento">
            <label for="document" class="form-label">Documento de identidad</label>
            <input 
                type="text" 
                name="document" 
                id="document" 
                class="form-control @error('document') is-invalid @enderror" 
                value="{{ old('document', $usuario->student->document ?? '') }}" 
                placeholder="Ej: 12345678"
            >
            @error('document')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Fecha de Nacimiento -->
        <div class="form-group mb-3" id="campo-fecha">
            <label for="birth_date" class="form-label">Fecha de nacimiento</label>
            <input 
                type="date" 
                name="birth_date" 
                id="birth_date" 
                class="form-control @error('birth_date') is-invalid @enderror" 
                value="{{ old('birth_date', $usuario->student->birth_date ?? '') }}"
            >
            @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div id="campos-profesor" style="display: none;">
    <div class="form-group mb-3">
        <label for="specialties" class="form-label">Especialidad</label>
        <select 
            name="specialties[]" 
            id="specialties" 
            class="form-select @error('specialties') is-invalid @enderror" 
            multiple 
            size="5"
        >
            @php
                // Asumiendo que $usuario->teacher->specialties o $usuario->specialties contiene un array/colección
                $selectedSpecialties = old('specialties', $usuario->teacher->specialties ?? []);
            @endphp
            <option value="Matemáticas" {{ in_array('Matemáticas', (array)$selectedSpecialties) ? 'selected' : '' }}>Matemáticas</option>
            <option value="Física" {{ in_array('Física', (array)$selectedSpecialties) ? 'selected' : '' }}>Física</option>
            <option value="Química" {{ in_array('Química', (array)$selectedSpecialties) ? 'selected' : '' }}>Química</option>
            <option value="Historia" {{ in_array('Historia', (array)$selectedSpecialties) ? 'selected' : '' }}>Historia</option>
            <option value="Biología" {{ in_array('Biología', (array)$selectedSpecialties) ? 'selected' : '' }}>Biología</option>
        </select>
        <small class="text-muted">Mantén presionado Ctrl (o Cmd en Mac) para seleccionar varias.</small>
        @error('specialties')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('role');
    const camposAlumno = document.getElementById('campos-alumno');
    const camposProfesor = document.getElementById('campos-profesor');

    function toggleCampos() {
        if (!roleSelect) return;

        const valor = roleSelect.value.trim().toLowerCase();

        // Manejar campos de Alumno
        if (camposAlumno) {
            camposAlumno.style.display = (valor === 'alumno') ? 'block' : 'none';
        }

        // Manejar campos de Profesor
        if (camposProfesor) {
            camposProfesor.style.display = (valor === 'profesor') ? 'block' : 'none';
        }
    }

    if (roleSelect) {
        toggleCampos();
        roleSelect.addEventListener('change', toggleCampos);
    }
});
</script>

@endsection

