@extends('layouts.profesor')
@section('content')
   <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center ">
                                    <div class="stats-icon mb-2 d-flex align-items-center justify-content-center float-none mx-auto" style="background-color: #1E1E2D">
                                        <x-fluentui-people-community-28 class="w-4 h-4 text-white"/>
                                    </div>
                                
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Sección A</h6>
                                    <h6 class="font-extrabold mb-0">0</h6> {{--Aquí debería mostrar el número real de estudiantes, {{ $totalStudents }}, el cual esta en el controlador pero no se muestra por alguna razon--}}
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card"> 
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center ">
                                    <div class="stats-icon mb-2 d-flex align-items-center justify-content-center float-none mx-auto" style="background-color: #1E1E2D">
                                        <x-fluentui-people-community-28 class="w-4 h-4 text-white"/>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Sección B</h6>
                                    <h6 class="font-extrabold mb-0">0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center ">
                                    <div class="stats-icon mb-2 d-flex align-items-center justify-content-center float-none mx-auto" style="background-color: #1E1E2D">
                                        <x-fluentui-people-community-28 class="w-4 h-4 text-white"/>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Sección C</h6>
                                    <h6 class="font-extrabold mb-0">0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center ">
                                    <div class="stats-icon red mb-2 d-flex align-items-center justify-content-center float-none mx-auto">
                                        <x-heroicon-s-book-open class="w-4 h-4 text-white"/>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total estudiantes</h6>
                                    <h6 class="font-extrabold mb-0">0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Estudiantes inscritos por mes</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
            </div>--}}
           <div class="row" id="table-striped">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Próxima evaluación sección A</h4>
                        </div>
                        <div class="card-content">
                            {{--<div class="card-body">
                                <p class="card-text">Use <code class="highlighter-rouge">.table-striped</code> to add
                                    zebra-striping to any                                        table row within the <code class="highlighter-rouge">&lt;tbody&gt;</code>. This styling
                                    doesn't work in E8
                                    and below as <code>:nth-child</code> CSS selector isn't supported.</p>
                            </div>--}}
                            <!-- table striped -->
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th>UNIDAD</th>
                                            <th>OBJETIVO</th>                                                
                                            <th>CONTENIDO</th>
                                            <th>TIPO DE EVALUACIÓN</th>
                                            <th>FECHA</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-bold-500">1</td>
                                            <td>Ingeniería de prompts</td>
                                            <td class="text-bold-500">Creación de contenido estructurado y resolución de problemas</td>
                                            <td>Prueba práctica</td>
                                            <td>12/04/2026</td>
                                            <td><a class="btn btn-success" href="#">HECHO</a></td>
                                          </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="table-striped">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Próxima evaluación sección B</h4>
                        </div>
                        <div class="card-content">
                            {{--<div class="card-body">
                                <p class="card-text">Use <code class="highlighter-rouge">.table-striped</code> to add
                                    zebra-striping to any                                        table row within the <code class="highlighter-rouge">&lt;tbody&gt;</code>. This styling
                                    doesn't work in E8
                                    and below as <code>:nth-child</code> CSS selector isn't supported.</p>
                            </div>--}}
                            <!-- table striped -->
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th>UNIDAD</th>
                                            <th>OBJETIVO</th>                                                
                                            <th>CONTENIDO</th>
                                            <th>TIPO DE EVALUACIÓN</th>
                                            <th>FECHA</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-bold-500">1</td>
                                            <td>Ingeniería de prompts</td>
                                            <td class="text-bold-500">Creación de contenido estructurado y resolución de problemas</td>
                                            <td>Prueba práctica</td>
                                            <td>12/04/2026</td>
                                            <td><a class="btn btn-success" href="#">HECHO</a></td>
                                          </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row" id="table-striped">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Próxima evaluación sección C</h4>
                        </div>
                        <div class="card-content">
                            {{--<div class="card-body">
                                <p class="card-text">Use <code class="highlighter-rouge">.table-striped</code> to add
                                    zebra-striping to any                                        table row within the <code class="highlighter-rouge">&lt;tbody&gt;</code>. This styling
                                    doesn't work in E8
                                    and below as <code>:nth-child</code> CSS selector isn't supported.</p>
                            </div>--}}
                            <!-- table striped -->
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th>UNIDAD</th>
                                            <th>OBJETIVO</th>                                                
                                            <th>CONTENIDO</th>
                                            <th>TIPO DE EVALUACIÓN</th>
                                            <th>FECHA</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-bold-500">1</td>
                                            <td>Ingeniería de prompts</td>
                                            <td class="text-bold-500">Creación de contenido estructurado y resolución de problemas</td>
                                            <td>Prueba práctica</td>
                                            <td>12/04/2026</td>
                                            <td><a class="btn btn-success" href="#">HECHO</a></td>
                                          </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Promedio general por curso</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <div class="d-flex align-items-center">
                                        <svg class="bi text-primary" width="32" height="32" fill="blue"
                                            style="width:10px">
                                            <use
                                                xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
                                        </svg>
                                        <h5 class="mb-0 ms-3">1° A </h5>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <h5 class="mb-0 text-end">8.5</h5>
                                </div>
                                <div class="col-12">
                                    <div id="chart-europe"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="d-flex align-items-center">
                                        <svg class="bi text-success" width="32" height="32" fill="blue"
                                            style="width:10px">
                                            <use
                                                xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
                                        </svg>
                                        <h5 class="mb-0 ms-3">2° A </h5>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <h5 class="mb-0 text-end">7.9</h5>
                                </div>
                                <div class="col-12">
                                    <div id="chart-america"></div> {{-- Aqui deberia estar el id del grado correspondiente, pero el id se mantiene finajo a la clave "indonesia" por alguna razon, revisar el codigo de dashboard.js para corregir esto. Lo mismo pasa con los id posteriores a este --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="d-flex align-items-center">
                                        <svg class="bi text-danger" width="32" height="32" fill="blue"
                                            style="width:10px">
                                            <use
                                                xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
                                        </svg>
                                        <h5 class="mb-0 ms-3">3° A </h5>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <h5 class="mb-0 text-end">9.1</h5>
                                </div>
                                <div class="col-12">
                                    <div id="chart-indonesia"></div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
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
                            <p class="font-bold">Último acceso: {{ auth()->user()->updated_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection