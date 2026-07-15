@extends('layouts.profesor')
@section('content')
<section class="section">
    <div class="row">
        <div class="container">
            <h1>Bienvenido, Profesor {{ Auth::user()->name }}</h1>
            <p>Esta es tu página de inicio. Aquí puedes gestionar tus cursos, ver tus estudiantes y más.</p>
        </div>
        
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                     <h4>Materias asignadas</h4>
                </div>
                <div class="card-body">
                    <p>A continuación despliegue la materia para ver su información</p>
                    
                    <div class="accordion" id="accordionMaterias">
                        @forelse($materias as $materia)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $materia->id }}">
                                    <button class="accordion-button collapsed" type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#collapse{{ $materia->id }}" 
                                        aria-expanded="false" 
                                        aria-controls="collapse{{ $materia->id }}">
                                        {{ strtoupper($materia->nombre) }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $materia->id }}" class="accordion-collapse collapse" 
                                    aria-labelledby="heading{{ $materia->id }}" 
                                    data-bs-parent="#accordionMaterias">
                                    <div class="accordion-body">
                                        <div class="table-responsive">
                                            <table class="table mb-0 text-center align-middle">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>MATERIA</th>
                                                        <th>DESCRIPCIÓN</th>
                                                        <th>TOTAL ESTUDIANTES</th>
                                                        <th>ACCION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-bold-500">{{ $materia->nombre }}</td>
                                                        <td>{{ $materia->descripcion ?? 'Sin descripción disponible' }}</td>
                                                        <td>{{ $materia->students_count }}</td>
                                                        <td>
                                                            <a href="{{ route('alumnos.index', ['id' => $materia->id]) }}" class="btn btn-sm btn-primary">
                                                                VER ALUMNOS
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-light-info text-center">
                                <p class="mb-0">No tienes materias asignadas actualmente.</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection