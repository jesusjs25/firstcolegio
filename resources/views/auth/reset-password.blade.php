<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña - {{ config('app.name') }}</title>
    
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="/"><img src="{{ asset('assets/compiled/svg/logo-firstcolegio.svg') }}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Restablecer contraseña</h1>
                    <p class="auth-subtitle mb-5">Ingresa tu nueva clave de acceso para actualizar tu cuenta.</p>

                    <!-- Errores de Validación -->
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Token de Password Reset (Oculto) -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Correo Electrónico (Solo lectura o precargado) -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" 
                                   name="email" 
                                   class="form-control form-control-xl @error('email') is-invalid @enderror" 
                                   placeholder="Correo Electrónico" 
                                   value="{{ old('email', $request->email) }}" 
                                   required 
                                   readonly>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>

                        <!-- Nueva Contraseña -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" 
                                   name="password" 
                                   class="form-control form-control-xl @error('password') is-invalid @enderror" 
                                   placeholder="Nueva contraseña" 
                                   required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" 
                                   name="password_confirmation" 
                                   class="form-control form-control-xl" 
                                   placeholder="Confirmar contraseña" 
                                   required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3">
                            Actualizar contraseña
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                </div>
            </div>
        </div>
    </div>
</body>
</html>