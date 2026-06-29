@extends ('layouts.perfil')

@section('title', 'Mi Perfil')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Mi Perfil</h3>
            </div>
        </div>
    </div>

    <section class="section mt-4">
        @if(session('success'))
            <div class="alert alert-light-success color-success alert-dismissible show fade">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

            <div class="row match-height">
                <!-- Columna: Datos Personales -->
                <div class="col-md-6 col-12">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-primary">Formulario - Datos Personales</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="name" class="mb-1 fw-bold text-secondary">Nombre Completo</label>
                                                <input type="text" id="name" class="form-control" name="name" value="{{ auth()->user()->name ?? '' }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label for="email" class="mb-1 fw-bold text-secondary">Correo Electrónico</label>
                                                <input type="email" id="email" class="form-control" name="email" value="{{ auth()->user()->email ?? '' }}" required>
                                                <button type="submit" class="btn btn-primary mt-4">Actualizar Datos</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

                <!-- Columna: Cambio de Contraseña -->
                <div class="col-md-6 col-12">
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-primary">Formulario - Cambio de Contraseña</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <div class="form-group">
                                                <label for="current_password" class="mb-1 fw-bold text-secondary">Contraseña Actual</label>
                                                <input type="password" id="current_password" class="form-control" name="current_password">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="form-group">
                                                <label for="password" class="mb-1 fw-bold text-secondary">Nueva Contraseña</label>
                                                <input type="password" id="password" class="form-control" name="password">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="form-group">
                                                <label for="password_confirmation" class="mb-1 fw-bold text-secondary">Confirmar Contraseña</label>
                                                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">
                                                @if ($errors->updatePassword->any())
                                                    <div class="alert alert-danger mt-2">
                                                        <ul>
                                                            @foreach ($errors->updatePassword->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <button type="submit" class="btn btn-success mt-4">Actualizar Contraseña</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection