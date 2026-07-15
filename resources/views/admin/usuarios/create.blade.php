
@extends('layouts.usuarios')

@section('content')
<div class="container mt-4">
	<h2>Crear Usuario</h2>
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form action="{{ route('admin.usuarios.store') }}" method="POST">
		@csrf

		<div class="mb-3">
			<label for="role" class="form-label">Rol</label>
			<select class="form-select" id="role" name="role" required>
				<option value="">Seleccione un rol</option>
				<option value="Admin">Administrador</option>
				<option value="Profesor">Profesor</option>
				<option value="Alumno">Alumno</option>
			</select>
		</div>

		<div class="mb-3">
			<label for="name" class="form-label">Nombre</label>
			<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
		</div>
		<div class="mb-3">
			<label for="email" class="form-label">Correo electrónico</label>
			<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">Contraseña</label>
			<input type="password" class="form-control" id="password" name="password" required>
		</div>
		<div class="mb-3">
			<label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
			<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
		</div>
		<div id="campos-alumno" style="display: none;">
            <div class="mb-3">
                <label for="document" class="form-label">Documento / DNI</label>
                <input type="text" inputmode="numeric" pattern="[0-9]*" name="document" id="document" class="form-control" value="{{ old('document') }}">
            </div>
            <div class="mb-3">
                <label for="birth_date" class="form-label">Fecha de Nacimiento</label>
                <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date') }}">
            </div>
        </div>

	<div id="campos-profesor" style="display: none;">
        <div class="form-group mb-3">
			<label class="form-label">Especialidad</label>
			<select name="specialty[]" id="specialty" class="form-control" multiple>
        <option value="Matemáticas">Matemáticas</option>
        <option value="Física">Física</option>
        <option value="Química">Química</option>
        <option value="Historia">Historia</option>
        <option value="Biología">Biología</option>
			</select>
    <small class="text-muted">Mantén presionado Ctrl (o Cmd en Mac) para seleccionar varias.</small>
		</div>
	</div>

		<button type="submit" class="btn btn-success">Registrar</button>
		<a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
	</form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectRol = document.getElementById('role');
    const camposAlumno = document.getElementById('campos-alumno');
    const camposProfesor = document.getElementById('campos-profesor');

    function alternarCampos() {
        const valor = selectRol.value;
        if (valor === 'Alumno') {
            camposAlumno.style.display = 'block';
            camposProfesor.style.display = 'none';
        } else if (valor === 'Profesor') {
            camposAlumno.style.display = 'none';
            camposProfesor.style.display = 'block';
        } else {
            camposAlumno.style.display = 'none';
            camposProfesor.style.display = 'none';
        }
    }

    // Escuchar cuando el usuario cambie de rol manualmente
    selectRol.addEventListener('change', alternarCampos);

    // Ejecutar al cargar la página por si regresa con errores de validación (Old input)
    alternarCampos();
});
</script>
@endsection
