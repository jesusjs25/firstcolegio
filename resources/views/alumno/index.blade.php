@extends('layouts.alumno')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Bienvenido, {{ auth()->user()->name ?? 'Estudiante' }} 👋</h3>
                <p class="text-subtitle text-muted">Panel de control y resumen académico escolar.</p>
            </div>
        </div>
    </div>

    <section class="section mt-4">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-4 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon purple mb-2">
                                    <i class="bi bi-book-half d-flex align-items-center justify-content-center text-white"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-8 col-xxl-7">
                                <h6 class="text-muted font-semibold">Materias Inscritas</h6>
                                <h6 class="font-extrabold mb-0">{{ $materias_count ?? '0' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-4 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon blue mb-2">
                                    <i class="bi bi-calendar-event d-flex align-items-center justify-content-center text-white"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-8 col-xxl-7">
                                <h6 class="text-muted font-semibold">Próximo Horario</h6>
                                <h6 class="font-bold mb-0 text-truncate" style="font-size: 0.9rem;">{{ $proximo_horario ?? 'Ver materias' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-4 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon green mb-2">
                                    <i class="bi bi-graph-up-arrow d-flex align-items-center justify-content-center text-white"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-8 col-xxl-7">
                                <h6 class="text-muted font-semibold">Promedio General</h6>
                                <h6 class="font-extrabold mb-0">{{ $promedio_general ?? '0.00' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-4 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon red mb-2">
                                    <i class="bi bi-journal-check d-flex align-items-center justify-content-center text-white"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-8 col-xxl-7">
                                <h6 class="text-muted font-semibold">Última Nota</h6>
                                <h6 class="font-bold mb-0 text-truncate" style="font-size: 0.85rem;">{{ $ultima_nota_publicada ?? 'Ninguna nueva' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection