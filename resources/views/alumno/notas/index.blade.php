@extends('layouts.alumno')

@section('title', 'Mis Notas')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Mis Notas - <span class="text-primary">{{ $materia->nombre ?? 'Materia' }}</span></h3>
                <p class="text-subtitle text-muted">Ruta: /alumno/notas/{materia}</p>
            </div>
        </div>
    </div>

    <section class="section mt-4">
        <!-- Tabla de Calificaciones -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Cortes del Periodo</h4>
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
                            @isset($evaluaciones)
                                @foreach($evaluaciones as $evaluacion)
                                <tr>
                                    <td class="text-bold-500">{{ $evaluacion->nombre }}</td>
                                    <td class="fw-bold text-primary">{{ $evaluacion->nota }}</td>
                                    <td>{{ $evaluacion->fecha }}</td>
                                    <td>{{ $evaluacion->profesor }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No hay registros de evaluaciones para esta asignatura.</td>
                                </tr>
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sección Resumen -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light-info py-3">
                        <h5 class="card-title mb-0 text-info">Resumen</h5>
                    </div>
                    <div class="card-body pt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>Promedio de la materia</span>
                                <span class="badge bg-info rounded-pill fw-bold">{{ $promedio_materia ?? '0.0' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>Estado</span>
                                @if(isset($estado_materia) && $estado_materia == 'Aprobado')
                                    <span class="badge bg-light-success text-success fw-bold px-3 py-2">Aprobado</span>
                                @elseif(isset($estado_materia) && $estado_materia == 'Reprobado')
                                    <span class="badge bg-light-danger text-danger fw-bold px-3 py-2">Reprobado</span>
                                @else
                                    <span class="badge bg-light-secondary text-secondary fw-bold px-3 py-2">Cursando</span>
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