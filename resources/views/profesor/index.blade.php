@extends('layouts.profesor')
@section('content')
<div class="container">
    <h1>Bienvenido, Profesor {{ Auth::user()->name }}</h1>
</div>
<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Notas Recientes</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Alumno</th>
                                <th>Evaluación</th>
                                <th>Nota</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notasRecientes as $nota)
                            <tr>
                                <td>{{ $nota->student->user->name }}</td>
                                <td>{{ $nota->nombre_nota }}</td>
                                <td><span class="badge bg-info">{{ $nota->valor_nota }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($nota->fecha_nota)->format('d/m/Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Aún no hay notas registradas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body py-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-xl">
                        <img src="./assets/compiled/jpg/gato.jpg" alt="Face 1">
                    </div>
                    <div class="ms-3 name">
                        <h5 class="font-bold">{{ auth()->user()->name }}</h5>
                        <h6 class="font-bold">{{ auth()->user()->email }}</h6>
                        <p class="font-bold">{{ auth()->user()->role }}</p>
                        <p class="font-bold">Último acceso: {{ auth()->user()->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection