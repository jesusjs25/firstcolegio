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

    <!-- Notificación de éxito -->
@if (session('status') === 'profile-updated' || session('success'))
    <div class="alert alert-success alert-dismissible show fade mb-4 d-flex align-items-center role="alert" style="border-radius: 10px;">
        <span class="me-2 fs-5">✅</span>
        <div>
            <strong>¡Éxito!</strong> Los cambios en tu perfil se guardaron correctamente.
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Notificación de actualización de contraseña (si Laravel Breeze envía 'password-updated') -->
@if (session('status') === 'password-updated')
    <div class="alert alert-success alert-dismissible show fade mb-4 d-flex align-items-center" role="alert" style="border-radius: 10px;">
        <span class="me-2 fs-5">🔒</span>
        <div>
            <strong>¡Contraseña actualizada!</strong> Tu contraseña ha sido cambiada con éxito.
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <section class="section mt-4">
        @if(session('success'))
            <div class="alert alert-light-success color-success alert-dismissible show fade">
                <span class="me-2 fs-5">✅</span> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

            <div class="row match-height">
                <!-- Columna: Datos Personales -->
                <div class="col-md-6 col-12">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                    <input type="hidden" name="email" value="{{ $user->email }}">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-primary">Formulario - Datos Personales</h4>
                        </div>

                    <div class="col-12 mb-4 text-center d-flex flex-column align-items-center">
                    <label for="avatar" class="w-100 mb-3 fw-bold text-secondary text-center">Foto de Perfil</label>
    

    <!-- Contenedor circular interactivo -->
    <div class="position-relative d-inline-block">
        <label for="avatar" style="cursor: pointer;">
            @if(auth()->user()->avatar)
                <img id="avatar-preview" src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                    class="rounded-circle border border-secondary" 
                    style="width: 130px; height: 130px; object-fit: cover;">
            @else
                <!-- Círculo por defecto con inicial o un icono si no hay foto -->
                <div id="avatar-preview-placeholder" class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white border border-light" 
                    style="width: 130px; height: 130px; font-size: 3rem; font-weight: bold;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <!-- Imagen oculta por defecto que usaremos para la previsualización -->
                <img id="avatar-preview" src="" class="rounded-circle border border-secondary d-none" 
                    style="width: 130px; height: 130px; object-fit: cover;">
            @endif
            
            <!-- Badge / Indicador de "Editar" -->
            <span class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                style="width: 32px; height: 32px; font-size: 0.85rem; border: 2px solid #1a1e29;">
                📷
            </span>
        </label>
    </div>

    <!-- El input original oculto para que no arruine el diseño -->
    <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
    <small class="text-muted d-block mt-2">Haz clic en el círculo para cambiar la foto</small>
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
                                                <span class="form-control-plaintext fw-semibold text-muted">{{ auth()->user()->email }}</span>
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

<script>
    document.getElementById('avatar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = document.getElementById('avatar-preview');
                const placeholder = document.getElementById('avatar-preview-placeholder');

                // Asignar la imagen cargada
                previewImg.src = e.target.result;
                previewImg.classList.remove('d-none'); // Mostrar la imagen

                // Si existía el círculo gris con la letra inicial, ocultarlo
                if (placeholder) {
                    placeholder.classList.add('d-none');
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection