@extends('layouts.profesor')
@section('content')
    <div class="container">
        <h1>Bienvenido, Profesor {{ Auth::user()->name }}</h1>
        <p>Esta es tu página de inicio. Aquí puedes gestionar tus cursos, ver tus estudiantes y más.</p>
    </div>
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header">
                 <h4>Planes de evaluación</h4>
            </div>
            <div class="card-body">
				<p>A continuación haga clic en cada sección para ver sus planes de evaluación:</p>
                <div class="accordion" id="accordionExample">
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingOne">
							<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Sección A
							</button>
						</h2>
		    			<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
							<div class="accordion-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 text-center align-middle"> 
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>UNIDAD</th>
                                                <th>OBJETIVO</th>
                                                <th>CONTENIDO</th>
                                                <th>TIPO DE EVALUACIÓN</th>
                                                <th>PUNTUACIÓN</th>
                                                <th>FECHA</th>
                                                <th>ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="2" class="text-bold-500">1</td>
                                                <td rowspan="2">Ingeniería de prompts</td>
                                                <td rowspan="2" class="text-bold-500">Creación de contenido estructurado y resolución de problemas</td>
                                                <td>Prueba práctica</td>
                                                <td>4 pts</td>
                                                <td>12/04/2026</td>
                                                <td><span class="badge bg-success">Realizado</span></td>
                                            </tr>
                                            <tr>
                                                <td>Debate</td>
                                                <td>2 pts</td>
                                                <td>19/04/2026</td>
                                                <td><span class="badge bg-danger">No iniciado</span></td>
                                            </tr>

                                            <tr>
                                                <td rowspan="2" class="text-bold-500">1</td>
                                                <td rowspan="2">Generador de contenido multimedia</td>
                                                <td rowspan="2" class="text-bold-500">Creación de la identidad visual (logos y fotos) para una marca o proyecto.</td>
                                                
                                                <td>Prueba práctica</td>
                                                <td>4 pts</td>
                                                <td>1/05/2026</td>
                                                <td><span class="badge bg-danger">No iniciado</span></td>
                                            </tr>
                                            <tr>
                                                <td>Debate</td>
                                                <td>2 pts</td>
                                                <td>19/05/2026</td>
                                                <td><span class="badge bg-danger">No iniciado</span></td>
                                            </tr>

                                            <tr>
                                                <td rowspan="2" class="text-bold-500">1</td>
                                                <td rowspan="2">Diseño web no-code</td>
                                                <td rowspan="2" class="text-bold-500">Crear una página web completa (puede ser su CV o un negocio) usando IA que genera el diseño y el código automáticamente.</td>
                                                <td>Prueba práctica</td>
                                                <td>4 pts</td>
                                                <td>12/06/2026</td>
                                                <td><span class="badge bg-danger">No iniciado</span></td>
                                            </tr>
                                            <tr>
                                                <td>Debate</td>
                                                <td>2 pts</td>
                                                <td>12/06/2026</td>
                                                <td><span class="badge bg-danger">No iniciado</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingTwo">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								Sección B
							</button>
						</h2>
						<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
							<div class="accordion-body">
								<div class="table-responsive">
                                    <table class="table mb-0 text-center align-middle"> 
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>UNIDAD</th>
                                                <th>OBJETIVO</th>
                                                <th>CONTENIDO</th>
                                                <th>TIPO DE EVALUACIÓN</th>
                                                <th>PUNTUACIÓN</th>
                                                <th>FECHA</th>
                                                <th>ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="2" class="text-bold-500">1</td>
                                                <td rowspan="2">Ingeniería de prompts</td>
                                                <td rowspan="2" class="text-bold-500">Creación de contenido estructurado y resolución de problemas</td>
                                                <td>Prueba práctica</td>
                                                <td>4 pts</td>
                                                <td>12/04/2026</td>
                                                <td><span class="badge bg-success">Realizado</span></td>
                                            </tr>
                                            <tr>
                                                <td>Debate</td>
                                                <td>2 pts</td>
                                                <td>19/04/2026</td>
                                                <td><span class="badge bg-danger">No iniciado</span></td>
                                            </tr>

                                            <tr>
                                                <td rowspan="2" class="text-bold-500">1</td>
                                                <td rowspan="2">Generador de contenido multimedia</td>
                                                <td rowspan="2" class="text-bold-500">Creación de la identidad visual (logos y fotos) para una marca o proyecto.</td>
                                                
                                                <td>Prueba práctica</td>
                                                <td>4 pts</td>
                                                <td>1/05/2026</td>
                                                <td><span class="badge bg-danger">No iniciado</span></td>
                                            </tr>
                                            <tr>
                                                <td>Debate</td>
                                                <td>2 pts</td>
                                                <td>19/05/2026</td>
                                                <td><span class="badge bg-danger">No iniciado</span></td>
                                            </tr>

                                            <tr>
                                                <td rowspan="2" class="text-bold-500">1</td>
                                                <td rowspan="2">Diseño web no-code</td>
                                                <td rowspan="2" class="text-bold-500">crean una página web completa (puede ser su CV o un negocio) usando IA que genera el diseño y el código automáticamente.</td>
                                                <td>Prueba práctica</td>
                                                <td>4 pts</td>
                                                <td>12/06/2026</td>
                                                <td><span class="badge bg-danger">No iniciado</span></td>
                                            </tr>
                                            <tr>
                                                <td>Debate</td>
                                                <td>2 pts</td>
                                                <td>12/06/2026</td>
                                                <td><span class="badge bg-danger">No iniciado</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingThree">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								Sección C
							</button>
						</h2>
						<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
							<div class="accordion-body">
								<h3>No hay plan de evaluación</h3>
                                <p>Pulse el botón "Crear" para crear uno.</p>
                                <br><br>
                                <a class="btn btn-success" href="{{ route('profesor.materias.create') }}">Crear</a>

							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
@endsection