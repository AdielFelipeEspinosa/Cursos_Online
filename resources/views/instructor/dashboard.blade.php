@extends('layouts.instructor')

@section('title', 'Dashboard Instructor')

@section('content')

<div class="text-center mb-5">
    <h1>Bienvenido, {{ Auth::user()->name }}</h1>
    <p class="lead text-muted">Panel de Control del Instructor</p>
</div>

<div class="row">
    <!-- Estadística: Total de Cursos -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="contact-form bg-dark rounded p-4 text-center">
            <h2 class="text-white mb-2">{{ Auth::user()->cursosComoInstructor()->count() }}</h2>
            <p class="text-white mb-0">Cursos Creados</p>
        </div>
    </div>

    <!-- Estadística: Cursos Publicados -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="contact-form bg-dark rounded p-4 text-center">
            <h2 class="text-white mb-2">{{ Auth::user()->cursosComoInstructor()->where('esta_publicado', true)->count() }}</h2>
            <p class="text-white mb-0">Cursos Publicados</p>
        </div>
    </div>

    <!-- Estadística: Total de Estudiantes -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="contact-form bg-dark rounded p-4 text-center">
            <h2 class="text-white mb-2">
                {{ Auth::user()->cursosComoInstructor()->withCount('inscripciones')->get()->sum('inscripciones_count') }}
            </h2>
            <p class="text-white mb-0">Estudiantes Inscritos</p>
        </div>
    </div>

    <!-- Estadística: Total de Reseñas -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="contact-form bg-dark rounded p-4 text-center">
            <h2 class="text-white mb-2">
                {{ Auth::user()->cursosComoInstructor()->withCount('reseñas')->get()->sum('reseñas_count') }}
            </h2>
            <p class="text-white mb-0">Reseñas Recibidas</p>
        </div>
    </div>
</div>

<!-- Accesos Rápidos -->
<div class="row mt-4">
    <div class="col-lg-6 mb-4">
        <div class="contact-form bg-dark rounded p-5 text-center">
            <h4 class="text-white mb-3">Gestionar Cursos</h4>
            <p class="text-white mb-4">Administra tus cursos, lecciones y materiales</p>
            <a href="{{ route('cursos.index') }}" class="btn btn-primary py-3 px-5">Ir a Mis Cursos</a>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="contact-form bg-dark rounded p-5 text-center">
            <h4 class="text-white mb-3">Crear Nuevo Curso</h4>
            <p class="text-white mb-4">Comienza a crear un nuevo curso para tus estudiantes</p>
            <a href="{{ route('cursos.create') }}" class="btn btn-primary py-3 px-5">Crear Curso</a>
        </div>
    </div>
</div>

<!-- Cursos Recientes -->
@if(Auth::user()->cursosComoInstructor()->count() > 0)
<div class="mt-5">
    <h3 class="mb-4">Mis Cursos Recientes</h3>
    <div class="row">
        @foreach(Auth::user()->cursosComoInstructor()->latest()->take(3)->get() as $curso)
        <div class="col-lg-4 mb-4">
            <div class="contact-form bg-dark rounded p-4">
                <img src="{{ $curso->url_imagen }}" alt="{{ $curso->titulo }}" class="img-fluid rounded mb-3" style="width: 100%; height: 200px; object-fit: cover;">
                <h5 class="text-white mb-2">{{ $curso->titulo }}</h5>
                <p class="text-white mb-2">
                    <small>{{ $curso->inscripciones()->count() }} estudiantes inscritos</small>
                </p>
                <a href="{{ route('cursos.show', $curso) }}" class="btn btn-primary btn-sm btn-block">Ver Curso</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection