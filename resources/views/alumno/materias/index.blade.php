@extends('layouts.alumno')

@section('title', 'Mis Materias')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Mis Materias</h3>
                <p class="text-subtitle text-muted">Ruta: /alumno/materias</p>
            </div>
        </div>
    </div>

    <section class="section mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Asignaturas Cursadas</h4>
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
                            @isset($materias)
                                @foreach($materias as $materia)
                                <tr>
                                    <td class="text-bold-500">{{ $materia->nombre }}</td>
                                    <td>{{ $materia->profesor }}</td>
                                    <td>{{ $materia->horario }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('/alumno/notas/'.$materia->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">
                                            <i class="bi bi-eye-fill me-1"></i> Ver notas
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No estás inscrito en ninguna materia actualmente.</td>
                                </tr>
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection