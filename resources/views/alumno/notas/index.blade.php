@extends('layouts.alumno')

@section('title', 'Mis Notas')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Registro de Calificaciones</h3>
                <p class="text-subtitle text-muted">Materia: <span class="text-primary fw-bold">{{ $materia->nombre ?? 'Asignatura' }}</span></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first text-md-end mb-3">
                <a href="{{ url('/alumno/materias') }}" class="btn btn-secondary btn-sm rounded-pill px-3">
                    <i class="bi bi-arrow-left me-1"></i> Volver a mis materias
                </a>
            </div>
        </div>
    </div>

    <section class="section mt-3">
        <div class="card shadow-sm">
            <div class="card-header bg-transparent">
                <h4 class="card-title mb-0">Evaluaciones Parciales</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Evaluación</th>
                                <th>Nota</th>
                                <th>Fecha</th>
                                <th>Profesor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($evaluaciones) && count($evaluaciones) > 0)
                                @foreach($evaluaciones as $evaluacion)
                                <tr>
                                    <td class="text-bold-500">{{ $evaluacion->nombre }}</td>
                                    <td class="fw-bold {{ $evaluacion->nota >= 10 ? 'text-success' : 'text-danger' }}">
                                        {{ $evaluacion->nota }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($evaluacion->fecha)->format('d/m/Y') }}</td>
                                    <td>{{ $materia->profesor->name ?? 'Docente' }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="bi bi-info-circle me-1"></i> Aún no se han cargado notas para este corte.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 col-12">
                <div class="card border-start border-info border-4 shadow-sm">
                    <div class="card-header bg-light-info py-3">
                        <h5 class="card-title mb-0 text-info">Resumen Académico</h5>
                    </div>
                    <div class="card-body pt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                                <span class="text-secondary font-semibold">Promedio de la materia</span>
                                <span class="badge bg-info rounded-pill fw-bold" style="font-size: 0.9rem;">
                                    {{ number_format($promedio_materia ?? 0, 2) }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                                <span class="text-secondary font-semibold">Estado Actual</span>
                                @if(isset($estado_materia) && $estado_materia == 'Aprobado')
                                    <span class="badge bg-light-success text-success fw-bold px-3 py-2 rounded-pill">Aprobado</span>
                                @elseif(isset($estado_materia) && $estado_materia == 'Reprobado')
                                    <span class="badge bg-light-danger text-danger fw-bold px-3 py-2 rounded-pill">Reprobado</span>
                                @else
                                    <span class="badge bg-light-warning text-warning fw-bold px-3 py-2 rounded-pill">Cursando</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection