@extends('layouts.alumno')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Mis Materias</h3>
                <p class="text-subtitle text-muted">Lista de asignaturas en las que te encuentras inscrito.</p>
            </div>
        </div>
    </div>

    <section class="section mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-transparent py-3">
                <h4 class="card-title mb-0">Carga Académica Activa</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Materia</th>
                                <th>Profesor</th>
                                <th>Horario</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($materias) && count($materias) > 0)
                                @foreach($materias as $materia)
                                <tr>
                                    <td class="text-bold-500 fw-bold">{{ $materia->nombre }}</td>
                                    <td>{{ $materia->profesor->name ?? 'Por asignar' }}</td>
                                    <td>{{ $materia->horario }}</td>
                                    <td class="text-center">
                                        {{-- Redirecciona al detalle de notas de esta materia en específico --}}
                                        <a href="{{ url('/alumno/notas/'.$materia->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="bi bi-eye-fill me-1"></i> Visualizar Calificaciones
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="bi bi-exclamation-circle me-1"></i> No registras materias inscritas para este periodo académico.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection