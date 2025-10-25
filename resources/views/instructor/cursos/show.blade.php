@extends('layouts.instructor')

@section('title', 'Detalles del Curso')

@section('content')

<!-- Encabezado del curso -->
<div class="row mb-4">
    <div class="col-lg-8">
        <h1>{{ $curso->titulo }}</h1>
        <p class="lead text-muted">{{ $curso->categoria->nombre }}</p>
    </div>
    <div class="col-lg-4 text-right">
        <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-warning py-2 px-4 mr-2">Editar Curso</a>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary py-2 px-4">Volver</a>
    </div>
</div>

<!-- Información del curso -->
<div class="row">
    <div class="col-lg-8">
        <div class="contact-form bg-secondary rounded p-4 mb-4">
            <h4 class="text-white mb-3">Descripción</h4>
            <p class="text-white">{{ $curso->descripcion }}</p>
        </div>

        <!-- Lista de lecciones -->
        <div class="contact-form bg-secondary rounded p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-white mb-0">Lecciones ({{ $curso->lecciones->count() }})</h4>
                <a href="#" class="btn btn-primary btn-sm">Añadir Lección</a>
            </div>

            @if($curso->lecciones->count() > 0)
            <div class="list-group">
                @foreach($curso->lecciones as $leccion)
                <div class="list-group-item bg-dark text-white mb-2 rounded">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">{{ $leccion->orden }}. {{ $leccion->titulo }}</h6>
                            <small>{{ $leccion->duracion_minutos }} minutos</small>
                        </div>
                        <div>
                            <a href="#" class="btn btn-sm btn-warning mr-1">Editar</a>
                            <form action="#" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta lección?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-white text-center mb-0">No hay lecciones en este curso</p>
            @endif
        </div>
    </div>

    <!-- Sidebar con información adicional -->
    <div class="col-lg-4">
        <!-- Imagen del curso -->
        <div class="contact-form bg-secondary rounded p-3 mb-4">
            <img src="{{ $curso->url_imagen }}" 
                 alt="{{ $curso->titulo }}" 
                 class="img-fluid rounded"
                 style="width: 100%; height: 200px; object-fit: cover;">
        </div>

        <!-- Estadísticas -->
        <div class="contact-form bg-secondary rounded p-4 mb-4">
            <h5 class="text-white mb-3">Estadísticas</h5>
            
            <div class="mb-3">
                <p class="text-white mb-1"><strong>Estado:</strong></p>
                <span class="badge badge-{{ $curso->esta_publicado ? 'success' : 'danger' }}">
                    {{ $curso->esta_publicado ? 'Publicado' : 'No Publicado' }}
                </span>
            </div>

            <div class="mb-3">
                <p class="text-white mb-1"><strong>Lecciones:</strong></p>
                <p class="text-white mb-0">{{ $curso->lecciones->count() }} lecciones</p>
            </div>

            <div class="mb-3">
                <p class="text-white mb-1"><strong>Duración Total:</strong></p>
                <p class="text-white mb-0">{{ $curso->duracionTotal() }} minutos</p>
            </div>

            <div class="mb-3">
                <p class="text-white mb-1"><strong>Estudiantes Inscritos:</strong></p>
                <p class="text-white mb-0">{{ $curso->inscripciones->count() }}</p>
            </div>

            <div class="mb-3">
                <p class="text-white mb-1"><strong>Calificación:</strong></p>
                <p class="text-white mb-0">
                    {{ number_format($curso->promedioCalificaciones(), 1) }} ⭐ 
                    ({{ $curso->reseñas->count() }} reseñas)
                </p>
            </div>

            <div>
                <p class="text-white mb-1"><strong>Creado:</strong></p>
                <p class="text-white mb-0">{{ $curso->created_at->format('d/m/Y') }}</p>
            </div>
        </div>

        <!-- Acciones -->
        <div class="contact-form bg-secondary rounded p-4">
            <h5 class="text-white mb-3">Acciones</h5>
            <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-warning btn-block mb-2">Editar Curso</a>
            <form action="{{ route('cursos.destroy', $curso) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este curso?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-block">Eliminar Curso</button>
            </form>
        </div>
    </div>
</div>

@endsection