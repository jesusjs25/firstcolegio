

@extends('layouts.materias')

@section('content')
<div class="container mt-4">
	<h2>Crear Materia</h2>
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form action="{{ route('admin.materias.store') }}" method="POST">
		@csrf
		<div class="mb-3">
			<label for="name" class="form-label">Nombre</label>
			<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
		</div>
		<div class="mb-3">
			<label for="description" class="form-label">Descripción</label>
			<input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" required>
		</div>
		<div class="mb-3">
			<label for="teacher_id" class="form-label">Profesor</label>
		<select name="teacher_id" class="form-select" id="teacher_id" required>
			<option value="">Seleccione un profesor</option>
		@foreach ($profesores as $profesor)
			<option value="{{ $profesor->id }}">{{ $profesor->name }}</option>
		@endforeach
	</select>
		</div>
		<div class="mb-3">
			<label for="estudiantes" class="form-label">Estudiantes</label>
			<select class="form-select" id="estudiantes" name="estudiantes[]" multiple>
				@foreach($estudiantes as $estudiante)
					<option value="{{ $estudiante->id }}">{{ $estudiante->name }}</option>
				@endforeach
			</select>
			<small class="text-muted">Mantén presionada la tecla Ctrl (Windows) o Cmd (Mac) para seleccionar varios estudiantes.</small>
		</div>
		<button type="submit" class="btn btn-success">Registrar</button>
		<a href="{{ route('admin.materias.index') }}" class="btn btn-secondary">Cancelar</a>
	</form>
</div>
@endsection