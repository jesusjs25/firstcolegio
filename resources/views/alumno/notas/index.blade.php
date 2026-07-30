@extends('layouts.alumno')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Calificaciones Generales</h3>
                <p class="text-subtitle text-muted">Consulta directa de tus notas y rendimientos del periodo actual.</p>
            </div>
        </div>
    </div>

    <section class="section mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-transparent py-3">
                <h4 class="card-title mb-0">Rendimiento por Materia</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Materia</th>
                                <th>Profesor</th>
                                <th class="text-center">Promedio Actual</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($materias_notas) && count($materias_notas) > 0)
                                @foreach($materias_notas as $item)
                                <tr>
                                    <td class="text-bold-500 fw-bold text-dark">{{ $item->nombre }}</td>
                                    <td>{{ $item->profesor->name ?? 'Docente asignado' }}</td>
                                    <td class="text-center fw-bold {{ ($item->promedio ?? 0) >= 10 ? 'text-success' : 'text-danger' }}">
                                        {{ number_format($item->promedio ?? 0, 2) }}
                                    </td>
                                    <td class="text-center">
                                        @if(($item->estado ?? '') == 'Aprobado')
                                            <span class="badge bg-light-success text-success fw-bold px-3 py-1 rounded-pill">Aprobado</span>
                                        @elseif(($item->estado ?? '') == 'Reprobado')
                                            <span class="badge bg-light-danger text-danger fw-bold px-3 py-1 rounded-pill">Reprobado</span>
                                        @else
                                            <span class="badge bg-light-warning text-warning fw-bold px-3 py-1 rounded-pill">Cursando</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                {{-- Registro simulado por si aún no conectas tu controlador --}}
                                <tr>
                                    <td class="text-bold-500 fw-bold text-dark">Matemáticas I</td>
                                    <td>Prof. Carlos Mendoza</td>
                                    <td class="text-center fw-bold text-success">16.50</td>
                                    <td class="text-center">
                                        <span class="badge bg-light-success text-success fw-bold px-3 py-1 rounded-pill">Aprobado</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold-500 fw-bold text-dark">Historia Universal</td>
                                    <td>Profra. Elena Gómez</td>
                                    <td class="text-center fw-bold text-success">14.00</td>
                                    <td class="text-center">
                                        <span class="badge bg-light-success text-success fw-bold px-3 py-1 rounded-pill">Aprobado</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold-500 fw-bold text-dark">Física Avanzada</td>
                                    <td>Prof. Andrés Silva</td>
                                    <td class="text-center fw-bold text-danger">09.00</td>
                                    <td class="text-center">
                                        <span class="badge bg-light-danger text-danger fw-bold px-3 py-1 rounded-pill">Reprobado</span>
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
                <div class="card border-start border-primary border-4 shadow-sm">
                    <div class="card-header bg-light-primary py-3">
                        <h5 class="card-title mb-0 text-primary">Resumen Global</h5>
                    </div>
                    <div class="card-body pt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                                <span class="text-secondary font-semibold">Promedio General Acumulado</span>
                                <span class="badge bg-primary rounded-pill fw-bold" style="font-size: 0.9rem;">
                                    {{ number_format($promedio_general ?? 13.16, 2) }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                                <span class="text-secondary font-semibold">Materias Aprobadas</span>
                                <span class="badge bg-success rounded-pill fw-bold">2</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                                <span class="text-secondary font-semibold">Materias Reprobadas</span>
                                <span class="badge bg-danger rounded-pill fw-bold">1</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection