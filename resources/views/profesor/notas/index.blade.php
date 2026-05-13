@extends('layouts.profesor')
@section('content')
    <div class="container">
        <h1>Bienvenido, Profesor {{ Auth::user()->name }}</h1>
        <p>Haga clic en uno de los enlaces del menú para gestionar las notas de los estudiantes.</p>
    </div>
    <section class="section">
        <div class="row" id="table-borderless">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">CREAR NOTA</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Complete el formulario para crear una nueva nota.</p>
                        </div>
                        <!-- table with no border -->
                        <div class="table-responsive">
                            <table class="table table-borderless text-center mb-0">
                                <thead>
                                    <tr>
                                        <th>AÑO</th>
                                        <th>ALUMNO</th>
                                        <th>EVALUACION</th>
                                        <th>PUNTAJE</th>
                                        <th>FECHA</th>
                                        <th>ACCION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-bold-500">
                                            <select class="choices form-select">
                                                <option value="square">Square</option>
                                                <option value="rectangle">Rectangle</option>
                                                <option value="rombo">Rombo</option>
                                                <option value="romboid">Romboid</option>
                                                <option value="trapeze">Trapeze</option>
                                                <option value="traible">Triangle</option>
                                                <option value="polygon">Polygon</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="choices form-select">
                                                <option value="square">Square</option>
                                                <option value="rectangle">Rectangle</option>
                                                <option value="rombo">Rombo</option>
                                                <option value="romboid">Romboid</option>
                                                <option value="trapeze">Trapeze</option>
                                                <option value="traible">Triangle</option>
                                                <option value="polygon">Polygon</option>
                                            </select>
                                        </td>
                                        <td class="text-bold-500">
                                            <select class="choices form-select">
                                                <option value="square">Square</option>
                                                <option value="rectangle">Rectangle</option>
                                                <option value="rombo">Rombo</option>
                                                <option value="romboid">Romboid</option>
                                                <option value="trapeze">Trapeze</option>
                                                <option value="traible">Triangle</option>
                                                <option value="polygon">Polygon</option>
                                            </select>
                                        </td>
                                        <td style="width: 100px; margin: auto;">
                                            <div>
                                                <input type="text" class="form-control" id="basicInput">
                                            </div>
                                        </td>
                                        <td style="width: 150px; margin: auto;">
                                            <div>
                                                <input type="text" class="form-control flatpickr-no-config" placeholder="Seleccionar">
                                            </div>
                                        </td>
                                        <td style="width: 200px">
                                            <button class="btn btn-success">GUARDAR NOTA</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Gestionar notas por alumno</h4>
                    </div>
                    <div class="card-body">
						<p>Haga clic en una materia para ver sus alumnos.</p>
                        <div class="accordion" id="accordionExample">
							<div class="accordion-item">
								<h2 class="accordion-header" id="headingOne">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
									CRP INFORMÁTICA - 5to año
									</button>
								</h2>
								<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
									<div class="accordion-body">
                                        <h4>5to año</h4>
                                        <div class="table-responsive">
                                        <table class="table mb-0 text-center align-middle">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>APELLIDOS</th>
                                                    <th>NOMBRES</th>
                                                    <th>CÉDULA</th>
                                                    <th>PROMEDIO</th>
                                                    <th>ACCION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-bold-500">Perez Hernandez</td>
                                                    <td>Juan Antonio</td>
                                                    <td class="text-bold-500">V-12345678</td>
                                                    <td class="text-bold-500">8.5</td>
                                                    <td><a href="#">VER NOTAS</a>
                                                        <span class="text-muted mx-2">|</span>
                                                        <a href="#" class="btn btn-success">CREAR NOTAS</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Gomez Rodriguez</td>
                                                    <td>Maria Jose</td>
                                                    <td class="text-bold-500">V-87654321</td>
                                                    <td class="text-bold-500">6.8</td>
                                                    <td>
                                                        <a href="#">VER NOTAS</a>
                                                        <span class="text-muted mx-2">|</span>
                                                        <a href="#" class="btn btn-success">CREAR NOTAS</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
									</div>
								</div>
							</div>
                        </div>
                        <div class="accordion" id="accordionExample">
							<div class="accordion-item">
								<h2 class="accordion-header" id="headingTwo">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									CRP INFORMÁTICA - 5to año
									</button>
								</h2>
								<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
									<div class="accordion-body">
                                        <h4>5to año</h4>
                                        <div class="table-responsive">
                                        <table class="table mb-0 text-center align-middle">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>APELLIDOS</th>
                                                    <th>NOMBRES</th>
                                                    <th>CÉDULA</th>
                                                    <th>PROMEDIO</th>
                                                    <th>ACCION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-bold-500">Perez Hernandez</td>
                                                    <td>Juan Antonio</td>
                                                    <td class="text-bold-500">V-12345678</td>
                                                    <td class="text-bold-500">8.5</td>
                                                    <td><a href="#">VER NOTAS</a>
                                                        <span class="text-muted mx-2">|</span>
                                                        <a href="#" class="btn btn-success">CREAR NOTAS</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Gomez Rodriguez</td>
                                                    <td>Maria Jose</td>
                                                    <td class="text-bold-500">V-87654321</td>
                                                    <td class="text-bold-500">6.8</td>
                                                    <td>
                                                        <a href="#">VER NOTAS</a>
                                                        <span class="text-muted mx-2">|</span>
                                                        <a href="#" class="btn btn-success">CREAR NOTAS</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
									</div>
								</div>
							</div>
                        </div>
                        <div class="accordion" id="accordionExample">
							<div class="accordion-item">
								<h2 class="accordion-header" id="headingThree">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									CRP INFORMÁTICA - 5to año
									</button>
								</h2>
								<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
									<div class="accordion-body">
                                        <h4>5to año</h4>
                                        <div class="table-responsive">
                                        <table class="table mb-0 text-center align-middle">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>APELLIDOS</th>
                                                    <th>NOMBRES</th>
                                                    <th>CÉDULA</th>
                                                    <th>PROMEDIO</th>
                                                    <th>ACCION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-bold-500">Perez Hernandez</td>
                                                    <td>Juan Antonio</td>
                                                    <td class="text-bold-500">V-12345678</td>
                                                    <td class="text-bold-500">8.5</td>
                                                    <td><a href="#">VER NOTAS</a>
                                                        <span class="text-muted mx-2">|</span>
                                                        <a href="#" class="btn btn-success">CREAR NOTAS</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Gomez Rodriguez</td>
                                                    <td>Maria Jose</td>
                                                    <td class="text-bold-500">V-87654321</td>
                                                    <td class="text-bold-500">6.8</td>
                                                    <td>
                                                        <a href="#">VER NOTAS</a>
                                                        <span class="text-muted mx-2">|</span>
                                                        <a href="#" class="btn btn-success">CREAR NOTAS</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Inicializar Selects
            const selects = document.querySelectorAll('.choices');
            selects.forEach(el => {
                new Choices(el, { searchEnabled: true, itemSelectText: '' });
            });

            // 2. Inicializar Datepicker
            flatpickr(".flatpickr-no-config", {
                dateFormat: "d-m-Y",
            });
        });
    </script>
@endpush