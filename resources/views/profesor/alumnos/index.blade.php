@extends('layouts.profesor')
@section('content')
    <div class="container">
        <h1>Bienvenido, Profesor {{ Auth::user()->name }}</h1>
        <p>Gestión de estudiantes por materia asignada.</p>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Alumnos por materia</h4>
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionAlumnos">
                    @foreach($materias as $materia)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $materia->id }}">
                                <button class="accordion-button {{ $materia->id == $materiaSeleccionada->id ? '' : 'collapsed' }}" 
                                        type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse{{ $materia->id }}">
                                    {{ strtoupper($materia->nombre) }}
                                </button>
                            </h2>
                            
                            <div id="collapse{{ $materia->id }}" 
                                 class="accordion-collapse collapse {{ $materia->id == $materiaSeleccionada->id ? 'show' : '' }}" 
                                 data-bs-parent="#accordionAlumnos">
                                <div class="accordion-body">
                                    @if($materia->id == $materiaSeleccionada->id)
                                        <div class="table-responsive">
                                            <table class="table mb-0 text-center align-middle">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>NOMBRES Y APELLIDOS</th>
                                                        <th>CÉDULA</th>
                                                        <th>PROMEDIO</th>
                                                        <th>ACCION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($materiaSeleccionada->students as $alumno)
                                                        <tr>
                                                            <td>{{ $alumno->user->name }}</td>
                                                            <td>{{ $alumno->document ?? 'Sin documento' }}</td>
                                                            <td>{{ $alumno->pivot->promedio }}</td>
                                                            <td>
                                                                <a href="{{ route('profesor.notas.index', [$materiaSeleccionada->id, $alumno->id]) }}" class="btn btn-sm btn-success">VER NOTAS</a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr><td colspan="4">No hay alumnos en esta materia.</td></tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <a href="{{ route('alumnos.index', $materia->id) }}" class="btn btn-primary btn-sm">
                                                VER LISTA DE ESTUDIANTES
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection