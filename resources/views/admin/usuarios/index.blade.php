
@extends('layouts.usuarios')

@section('content')
<div class="container mt-4">
	<h2 class="mb-4">Usuarios</h2>

	{{-- Contador de usuarios por rol --}}
	<div class="row mb-4">
		<div class="col-md-4">
			<div class="card text-bg-primary mb-3">
				<div class="card-body">
					<h5 class="card-title">Administradores</h5>
					<p class="card-text display-6">{{ $usuarios->filter(fn($u) => $u->hasRole('Admin'))->count() }}</p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card text-bg-success mb-3">
				<div class="card-body">
					<h5 class="card-title">Profesores</h5>
					<p class="card-text display-6">{{ $usuarios->filter(fn($u) => $u->hasRole('Profesor'))->count() }}</p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card text-bg-info mb-3">
				<div class="card-body">
					<h5 class="card-title">Alumnos</h5>
					<p class="card-text display-6">{{ $usuarios->filter(fn($u) => $u->hasRole('Alumno'))->count() }}</p>
				</div>
			</div>
		</div>
	</div>

	{{-- Mensajes de éxito --}}
	@if(session('success'))
		<div class="alert alert-success">{{ session('success') }}</div>
	@endif

	<div class="mb-3">
		<a href="{{ route('usuarios.create') }}" class="btn btn-primary">Crear Usuario</a>
	</div>

	<div class="card">
		<div class="card-header">Lista de Usuarios</div>
		<div class="card-body">
			<table class="table table-striped" id="usuariosTable">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Email</th>
						<th>Rol</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($usuarios as $usuario)
						<tr>
							<td>{{ $usuario->name }}</td>
							<td>{{ $usuario->email }}</td>
							<td>{{ $usuario->getRoleNames()->implode(', ') }}</td>
							<td>
								<a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-sm btn-warning">Editar</a>
								<form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" style="display:inline-block;">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</button>
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