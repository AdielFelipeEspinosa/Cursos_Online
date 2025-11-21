@extends('layouts.app')

@section('title', 'Página de Inicio')

@section('content')

{{-- EDUCATIVO: Incluir assets de Lazy Loading --}}
{!! App\Helpers\LazyLoadHelper::renderAssets() !!}

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Courses</h5>
            <h1>Our Popular Courses</h1>
            
            {{-- EDUCATIVO: Indicador de performance --}}
            <p class="text-muted small mt-3">
                🚀 <strong>Lazy Loading activo</strong> - Las imágenes se cargan solo cuando son necesarias
            </p>
        </div>
        
        <div class="row">
            @foreach($cursos as $curso)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="rounded overflow-hidden mb-2">
                    
                    {{-- ANTES: <img class="img-fluid" src="{{ $curso->url_imagen }}" alt="{{ $curso->titulo }}"> --}}
                    {{-- DESPUÉS: Usando lazy loading con skeleton --}}
                    
                    <div class="lazy-image-wrapper skeleton-loader" data-loaded="false" style="height: 250px;">
                        <img 
                            class="img-fluid lazy-image" 
                            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
                            data-src="{{ $curso->url_imagen }}" 
                            alt="{{ $curso->titulo }}"
                            loading="lazy"
                            style="width: 100%; height: 250px; object-fit: cover;">
                    </div>
                    
                    <div class="bg-secondary p-4">
                        <a class="h5" href="{{ route('cursos.show', $curso) }}">{{ $curso->titulo }}</a>
                        <p>
                            {{ Str::limit($curso->descripcion, 100) }}
                        </p>
                        <a href="{{ route('cursos.show', $curso) }}" class="text-blue-500 mt-2 inline-block">Ver curso</a>
                        <div class="border-top mt-4 pt-4">
                            <div class="d-flex justify-content-between">
                                <h6 class="m-0">
                                    <i class="fa fa-star text-primary mr-2"></i>
                                    {{ number_format($curso->promedioCalificaciones(), 1) }} 
                                    <small>({{ $curso->reseñas->count() }})</small>
                                </h6>
                                <h5 class="m-0">
                                    {{ $curso->cantidadLecciones() }} lecciones
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- EDUCATIVO: Panel de métricas --}}
        @if($cursos->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <div class="contact-form bg-dark rounded p-4">
                    <h5 class="text-white mb-3">📊 Métricas de Performance (Lazy Loading)</h5>
                    <div class="row text-white">
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Total de imágenes:</strong></p>
                            <p class="h4">{{ $cursos->count() }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Mejora estimada:</strong></p>
                            <p class="h4 text-success">~{{ $cursos->count() * 0.3 }}s más rápido ⚡</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Datos ahorrados:</strong></p>
                            <p class="h4 text-info">~{{ $cursos->count() * 0.5 }}MB</p>
                        </div>
                    </div>
                    <p class="text-muted small mt-3 mb-0">
                        💡 <strong>Concepto:</strong> Con lazy loading, las imágenes fuera de la vista inicial no se cargan hasta que el usuario hace scroll. 
                        Esto mejora dramáticamente el tiempo de carga inicial de la página.
                    </p>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

{{-- EDUCATIVO: Botón para abrir consola y ver métricas --}}
<div class="position-fixed" style="bottom: 20px; right: 20px; z-index: 1000;">
    <button 
        class="btn btn-info btn-sm" 
        onclick="console.log('📊 Abre la consola del navegador (F12) para ver métricas de lazy loading')"
        title="Ver métricas en consola">
        📊 Ver métricas
    </button>
</div>
@endsection