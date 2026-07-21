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
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #d1e7dd; color: #0f5132; padding: 12px 15px; margin-bottom: 20px; border-radius: 6px; border: 1px solid #badbcc;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right; background: none; border: none; font-size: 18px; cursor: pointer; color: #0f5132;">&times;</button>
            </div>
        @endif
        <div class="card-body">
            <table class="table table-striped text-center align-middle">
                <thead class="thead-dark">
                    <tr>
                        <th>ALUMNO</th>
                        <th>EVALUACIÓN</th>
                        <th>VALOR TOTAL</th>
                        <th>NOTA</th>
                        <th>FECHA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notas as $nota)
                    <tr>
                        <td>{{ $student->user->name }}</td>
                        <td>{{ $nota->nombre_nota }}</td>
                        <td>{{ $nota->puntaje_maximo }}</td>
                        <td>{{ $nota->valor_nota }}</td>
                        <td>{{ $nota->fecha_nota }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" 
                                onclick="abrirModalEditar({{ $nota->id }}, '{{ $nota->nombre_nota }}', {{ $nota->puntaje_maximo }}, {{ $nota->valor_nota }}, '{{ $nota->fecha_nota }}')">
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
                        <td colspan="6" class="text-center">No hay notas registradas para este alumno.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- Modal Unificado para Crear y Editar --}}
<div class="modal fade" id="modalCrearNota" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('profesor.notas.store', [$materia->id, $student->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="materia_id" value="{{ $materia->id }}">
            <input type="hidden" name="student_id" value="{{ $student->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nota para {{ $student->user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Alerta para errores de Laravel (por si acaso el backend los devuelve) --}}
                    @if ($errors->any())
                        <div class="alert alert-danger" style="background-color: #f8d7da; color: #842029; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                            <ul style="margin: 0; padding-left: 15px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- NUEVO: Alerta dinámica para validación instantánea en JavaScript --}}
                    <div id="error-js" class="alert alert-danger d-none" style="background-color: #f8d7da; color: #842029; padding: 10px; margin-bottom: 15px; border-radius: 5px;"></div>

                    <div class="mb-3">
                        <label>Evaluación</label>
                        <input type="text" name="nombre_nota" value="{{ old('nombre_nota') }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Valor total (máximo 4 puntos)</label>
                        <select name="puntaje_maximo" id="puntaje_maximo" class="form-control" required>
                            <option value="">Seleccione el valor total</option>
                            <option value="1" {{ old('puntaje_maximo') == 1 ? 'selected' : '' }}>1 Punto</option>
                            <option value="2" {{ old('puntaje_maximo') == 2 ? 'selected' : '' }}>2 Puntos</option>
                            <option value="3" {{ old('puntaje_maximo') == 3 ? 'selected' : '' }}>3 Puntos</option>
                            <option value="4" {{ old('puntaje_maximo') == 4 ? 'selected' : '' }}>4 Puntos</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Nota</label>
                        <input type="number" step="0.01" name="valor_nota" id="valor_nota" value="{{ old('valor_nota') }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Fecha</label>
                        <input type="date" name="fecha_nota" value="{{ old('fecha_nota', date('Y-m-d')) }}" class="form-control" max="{{ date('Y-m-d') }}" required>
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
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('#modalCrearNota form');
    const inputNota = document.getElementById('valor_nota');
    const selectPuntaje = document.getElementById('puntaje_maximo');
    const errorDiv = document.getElementById('error-js');

    // Interceptar el evento de envío del formulario
    form.addEventListener('submit', function(event) {
        const valorNota = parseFloat(inputNota.value) || 0;
        const puntajeMaximo = parseInt(selectPuntaje.value) || 0;

        // Validar si la nota es mayor al puntaje total seleccionado
        if (valorNota > puntajeMaximo) {
            // Detener el envío del formulario y la recarga de la página
            event.preventDefault(); 
            
            // Mostrar el mensaje de error personalizado en el div en vivo
            errorDiv.innerHTML = `La nota (${valorNota}) no puede ser mayor al valor total de la evaluación (${puntajeMaximo} puntos).`;
            errorDiv.classList.remove('d-none'); // Hacer visible la alerta
            
            // Enfocar el campo de la nota para que el profesor lo corrija
            inputNota.focus();
        } else {
            // Ocultar el error si todo está bien y dejar que el formulario se envíe con normalidad
            errorDiv.classList.add('d-none');
        }
    });

    // Si Laravel ya había devuelto un error del backend, abrir el modal automáticamente
    @if ($errors->any())
        var myModal = new bootstrap.Modal(document.getElementById('modalCrearNota'));
        myModal.show();
    @endif
});

function resetModal() {
    const modal = document.getElementById('modalCrearNota');
    const form = modal.querySelector('form');
    const errorDiv = document.getElementById('error-js');
    
    form.action = "{{ route('profesor.notas.store', [$materia->id, $student->id]) }}";
    
    const methodInput = form.querySelector('input[name="_method"]');
    if (methodInput) {
        methodInput.remove();
    }
    
    form.reset();
    errorDiv.classList.add('d-none'); // Ocultar errores previos al limpiar
    modal.querySelector('.modal-title').innerText = 'Registrar Nueva Nota';
}

function abrirModalEditar(id, nombre, puntajeMax, valor, fecha) {
    const modal = document.getElementById('modalCrearNota');
    const form = modal.querySelector('form');
    const errorDiv = document.getElementById('error-js');
    
    form.action = `/profesor/notas/{{ $materia->id }}/{{ $student->id }}/${id}`;
    
    if (!form.querySelector('input[name="_method"]')) {
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        form.appendChild(methodInput);
    }

    modal.querySelector('input[name="nombre_nota"]').value = nombre;
    modal.querySelector('select[name="puntaje_maximo"]').value = puntajeMax;
    modal.querySelector('input[name="valor_nota"]').value = valor;
    modal.querySelector('input[name="fecha_nota"]').value = fecha;
    
    errorDiv.classList.add('d-none'); // Ocultar errores previos
    modal.querySelector('.modal-title').innerText = 'Editar Nota';
    
    var myModal = new bootstrap.Modal(modal);
    myModal.show();
}
</script>
<style>
    /* Aplica opacidad a los días futuros o deshabilitados en los inputs de fecha */
    input[type="date"]::-webkit-datetime-edit-fields-wrapper {
        display: flex;
    }
    /* Estilo para los inputs de fecha cuando están limitados por el atributo max */
    input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
    }
</style>
@endsection