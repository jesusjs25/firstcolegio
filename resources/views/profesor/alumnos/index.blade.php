@extends('layouts.profesor')
@section('content')
    <div class="container">
        <h1>Bienvenido, Profesor {{ Auth::user()->name }}</h1>
        <p>Esta es tu página de inicio. Aquí puedes gestionar tus cursos, ver tus estudiantes y más.</p>
    </div>
@endsection