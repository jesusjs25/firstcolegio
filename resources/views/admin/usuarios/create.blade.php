
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
	<form action="{{ route('usuarios.store') }}" method="POST">
		@csrf
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
		<div class="mb-3">
			<label for="role" class="form-label">Rol</label>
			<select class="form-select" id="role" name="role" required>
				<option value="">Seleccione un rol</option>
				<option value="Admin">Administrador</option>
				<option value="Profesor">Profesor</option>
				<option value="Alumno">Alumno</option>
			</select>
		</div>
		<button type="submit" class="btn btn-success">Registrar</button>
		<a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
	</form>
</div>
@endsection
