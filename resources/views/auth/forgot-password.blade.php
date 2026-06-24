<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - {{ config('app.name') }}</title>
    
    <!-- Usamos asset() para que Laravel busque en la carpeta public -->
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">
    
    <!-- Bootstrap Icons (necesario para los iconos de los inputs) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="/"><img src="{{ asset('assets/compiled/svg/logo.svg') }}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Recuperar contraseña</h1>
                    <p class="auth-subtitle mb-5">Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.</p>

                    <!-- Session Status (Mensaje de éxito si el correo se envió) -->
                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

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

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" 
                                name="email" 
                                class="form-control form-control-xl @error('email') is-invalid @enderror" 
                                placeholder="Correo electrónico" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            Enviar enlace
                        </button>
                    </form>

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>¿Recordaste tu contraseña? 
                            <a href="{{ route('login') }}" class="font-bold">Inicia sesión</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <!-- Aquí puedes poner una imagen de fondo en tu CSS si gustas -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>