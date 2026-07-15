@extends('layouts.profesor')
@section('content')
<div class="container">
    <h1>Bienvenido, Profesor {{ Auth::user()->name }}</h1>
    <p>Gestión de estudiantes por materia asignada.</p>
    <h4>Aquí podrá ver las notas de {{ $student->user->name }} en su materia {{ $materia->nombre }}</h4>
    <a href="{{ route('alumnos.index', $materia->id) }}" class="btn btn-secondary mb-3">Volver a la lista</a>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">DETALLE DE EVALUACIONES</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearNota" onclick="resetModal()">
                Registrar Nueva Nota
            </button>
        </div>
        <div class="card-body">
            <table class="table table-striped text-center align-middle">
                <thead class="thead-dark">
                    <tr>
                        <th>ALUMNO</th>
                        <th>EVALUACIÓN</th>
                        <th>VALOR</th>
                        <th>FECHA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notas as $nota)
                    <tr>
                        <td>{{ $student->user->name }}</td>
                        <td>{{ $nota->nombre_nota }}</td>
                        <td>{{ $nota->valor_nota }}</td>
                        <td>{{ $nota->fecha_nota }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" 
                                onclick="abrirModalEditar({{ $nota->id }}, '{{ $nota->nombre_nota }}', {{ $nota->valor_nota }}, '{{ $nota->fecha_nota }}')">
                                Editar
                            </button>
                            <form action="{{ route('profesor.notas.destroy', [$materia->id, $student->id, $nota->id]) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No hay notas registradas para este alumno.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- Modal --}}
<div class="modal fade" id="modalCrearNota" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('profesor.notas.store', [$materia->id, $student->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="materia_id" value="{{ $materia->id }}">
            <input type="hidden" name="student_id" value="{{ $student->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nota para {{ $student->user->name }}</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Evaluación</label>
                        <input type="text" name="nombre_nota" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Valor</label>
                        <input type="number" step="0.01" name="valor_nota" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Fecha</label>
                        <input type="date" name="fecha_nota" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Esta función se encarga de dejar el modal como "nuevo"
function resetModal() {
    const modal = document.getElementById('modalCrearNota');
    const form = modal.querySelector('form');
    
    // 1. Resetear el action a la ruta de guardar (store)
    form.action = "{{ route('profesor.notas.store', [$materia->id, $student->id]) }}";
    
    // 2. Eliminar el input hidden "_method" si existe (que es lo que indica edición)
    const methodInput = form.querySelector('input[name="_method"]');
    if (methodInput) {
        methodInput.remove();
    }
    
    // 3. Limpiar los campos del formulario
    form.reset();
    
    // 4. Resetear el título
    modal.querySelector('.modal-title').innerText = 'Registrar Nueva Nota';
}

// Y aquí mantenemos tu función de abrir para editar
function abrirModalEditar(id, nombre, valor, fecha) {
    const modal = document.getElementById('modalCrearNota');
    const form = modal.querySelector('form');
    
    form.action = `/profesor/notas/{{ $materia->id }}/{{ $student->id }}/${id}`;
    
    if (!form.querySelector('input[name="_method"]')) {
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        form.appendChild(methodInput);
    }

    modal.querySelector('input[name="nombre_nota"]').value = nombre;
    modal.querySelector('input[name="valor_nota"]').value = valor;
    modal.querySelector('input[name="fecha_nota"]').value = fecha;
    
    modal.querySelector('.modal-title').innerText = 'Editar Nota';
    
    // Abrir el modal usando Bootstrap 5
    var myModal = new bootstrap.Modal(modal);
    myModal.show();
}
</script>
@endsection