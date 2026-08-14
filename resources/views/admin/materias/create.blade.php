

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
			<input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
		</div>
		<div class="mb-3">
			<label for="name" class="form-label">Curso</label>
			<select name="curso" class="form-select" id="curso" required>
				<option value="">Seleccione un curso</option>
				<option value="1er año">1er año</option>
				<option value="2do año">2do año</option>
				<option value="3er año">3er año</option>
				<option value="4to año">4to año</option>
				<option value="5to año">5to año</option>
			</select>
		</div>
		<div class="mb-3">
			<label for="description" class="form-label">Descripción</label>
			<input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion') }}" required>
		</div>
		<div class="mb-3">
			<label for="teacher_id" class="form-label">Profesor</label>
			<select name="teacher_id" class="form-select" id="teacher_id" required>
				<option value="">Seleccione un profesor</option>
				@foreach ($profesores as $profesor)
					<option value="{{ $profesor->id }}">{{ $profesor->user->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="mb-3">
			<label for="name" class="form-label">Horario</label>
			<select name="horario" class="form-select" id="horario" required>
				<option value="">Seleccione un horario</option>
				<option value="7:00-8:20">7:00-8:20</option>
				<option value="8:20-9:40">8:20-9:40</option>
				<option value="10:00-11:20">10:00-11:20</option>
				<option value="11:20-12:30">11:20-12:30</option>
			</select>
		</div>
		<div class="mb-3">
			<label for="estudiantes" class="form-label">Estudiantes</label>
			<select class="form-select" id="estudiantes" name="estudiantes[]" multiple>
				@foreach($estudiantes as $estudiante)
					<option value="{{ $estudiante->id }}">{{ $estudiante->user->name }}</option>
				@endforeach
			</select>
			<small class="text-muted">Mantén presionada la tecla Ctrl (Windows) o Cmd (Mac) para seleccionar varios estudiantes.</small>
		</div>
		<button type="submit" class="btn btn-success">Registrar</button>
		<a href="{{ route('admin.materias.index') }}" class="btn btn-secondary">Cancelar</a>
	</form>
</div>
@endsection