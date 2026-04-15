
@extends('layouts.materias')

@section('content')
<div class="container mt-4">
	<h2 class="mb-4">Materias</h2>
	@if(session('success'))
		<div class="alert alert-success">{{ session('success') }}</div>
	@endif
	<div class="mb-3">
		<a href="{{ route('materias.create') }}" class="btn btn-primary">Crear Materia</a>
	</div>
	<div class="card">
		<div class="card-header">Lista de Materias</div>
		<div class="card-body">
			<table class="table table-striped" id="materiasTable">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Descripción</th>
						<th>Profesor</th>
						<th>Estudiantes</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($materias as $materia)
						<tr>
							<td>{{ $materia->name }}</td>
							<td>{{ $materia->description }}</td>
							<td>{{ $materia->profesor ? $materia->profesor->name : 'Sin asignar' }}</td>
							<td>{{ $materia->estudiantes->count() }}</td>
							<td>
								<a href="{{ route('materias.edit', $materia) }}" class="btn btn-sm btn-warning">Editar</a>
								<form action="{{ route('materias.destroy', $materia) }}" method="POST" style="display:inline-block;">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta materia?')">Eliminar</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection