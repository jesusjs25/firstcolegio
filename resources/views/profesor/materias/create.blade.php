@extends('layouts.profesor')


{{-- Formulario para crear un nuevo plan de evaluación --}}


@section('content')
<form action="#" method="post">
    @csrf
<section id="multiple-column-form">
    <div class="row match-height">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Nuevo plan de evaluación</h4>
          </div>
          <div class="card-content">
            <div class="card-body">
              <form class="form" data-parsley-validate>
                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="form-group mandatory">
                      <label for="first-name-column" class="form-label"
                        >Unidad</label
                      >
                      <input
                        type="text"
                        id="first-name-column"
                        class="form-control"
                        placeholder="Unidad"
                        name="fname-column"
                        data-parsley-required="true"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="last-name-column" class="form-label"
                        >Objetivo</label
                      >
                      <input
                        type="text"
                        id="last-name-column"
                        class="form-control"
                        placeholder="Objetivo"
                        name="lname-column"
                        data-parsley-required="true"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="city-column" class="form-label">Contenido</label>
                      <input
                        type="text"
                        id="city-column"
                        class="form-control"
                        placeholder="Contenido del objetivo"
                        name="city-column"
                        data-parsley-restricted-city="Jakarta"
                        data-parsley-required="true"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="country-floating" class="form-label"
                        >Tipo de evaluación</label
                      >
                      <input
                        type="text"
                        id="country-floating"
                        class="form-control"
                        name="country-floating"
                        placeholder="Tipo de evaluación"
                        data-parsley-required="true"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="company-column" class="form-label"
                        >Puntuación</label
                      >
                      <input
                        type="text"
                        id="company-column"
                        class="form-control"
                        name="company-column"
                        placeholder="Puntuación"
                        data-parsley-required="true"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group mandatory">
                      <label for="email-id-column" class="form-label"
                        >Fecha</label
                      >
                      <input
                        type="date"
                        id="email-id-column"
                        class="form-control"
                        name="email-id-column"
                        placeholder="Fecha"
                        data-parsley-required="true"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="country-floating" class="form-label"
                        >Tipo de evaluación</label
                      >
                      <input
                        type="text"
                        id="country-floating"
                        class="form-control"
                        name="country-floating"
                        placeholder="Tipo de evaluación"
                        data-parsley-required="true"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="company-column" class="form-label"
                        >Puntuación</label
                      >
                      <input
                        type="text"
                        id="company-column"
                        class="form-control"
                        name="company-column"
                        placeholder="Puntuación"
                        data-parsley-required="true"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group mandatory">
                      <label for="email-id-column" class="form-label"
                        >Fecha</label
                      >
                      <input
                        type="date"
                        id="email-id-column"
                        class="form-control"
                        name="email-id-column"
                        placeholder="Fecha"
                        data-parsley-required="true"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="country-floating" class="form-label"
                        >Tipo de evaluación</label
                      >
                      <input
                        type="text"
                        id="country-floating"
                        class="form-control"
                        name="country-floating"
                        placeholder="Tipo de evaluación"
                        data-parsley-required="true"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="company-column" class="form-label"
                        >Puntuación</label
                      >
                      <input
                        type="text"
                        id="company-column"
                        class="form-control"
                        name="company-column"
                        placeholder="Puntuación"
                        data-parsley-required="true"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group mandatory">
                      <label for="email-id-column" class="form-label"
                        >Fecha</label
                      >
                      <input
                        type="date"
                        id="email-id-column"
                        class="form-control"
                        name="email-id-column"
                        placeholder="Fecha"
                        data-parsley-required="true"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="company-column" class="form-label"
                        >Estado</label
                      >
                      <input
                        type="text"
                        id="company-column"
                        class="form-control"
                        name="company-column"
                        placeholder="Estado"
                        data-parsley-required="true"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-1 mb-1">
                      Subir
                    </button>
                    <button
                      type="reset"
                      class="btn btn-light-secondary me-1 mb-1"
                    >
                      Limpiar
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </form>
@endsection
