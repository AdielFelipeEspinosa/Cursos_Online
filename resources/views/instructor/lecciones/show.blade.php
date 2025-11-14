@extends('layouts.instructor')

@section('title', 'Detalles de la Lección')

@section('content')

<div class="row mb-4">
    <div class="col-lg-8">
        <h1>{{ $leccion->titulo }}</h1>
        <p class="lead text-muted">{{ $curso->titulo }}</p>
    </div>
    <div class="col-lg-4 text-right">
        <a href="{{ route('lecciones.edit', [$curso, $leccion]) }}" class="btn btn-warning py-2 px-4 mr-2">Editar</a>
        <a href="{{ route('lecciones.index', $curso) }}" class="btn btn-secondary py-2 px-4">Volver</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Video -->
        <div class="contact-form bg-secondary rounded p-4 mb-4">
            <h4 class="text-bg mb-3">Video de la Lección</h4>

            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item"
                    src="{{ $leccion->video_embed_url }}"
                    allowfullscreen>
                </iframe>

            </div>
        </div>

        <!-- Descripción -->
        <div class="contact-form bg-secondary rounded p-4 mb-4">
            <h4 class="text-bg mb-3">Descripción</h4>
            <p class="text-bg">{{ $leccion->descripcion }}</p>
        </div>

        <!-- Materiales -->
        <div class="contact-form bg-secondary rounded p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-bg mb-0">Materiales ({{ $leccion->materiales->count() }})</h4>
                <a href="{{ route('materiales.index', [$curso, $leccion]) }}" class="btn btn-primary btn-sm">Administrar Materiales</a>
                <a href="{{ route('materiales.create', [$curso, $leccion]) }}" class="btn btn-primary btn-sm">Crear Material</a>
            </div>

            @if($leccion->materiales->count() > 0)
            <div class="list-group">
                @foreach($leccion->materiales as $material)
                <div class="list-group-item bg-dark text-white mb-2 rounded">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1 text-white">{{ $material->titulo }}</h6>
                            <small>{{ $material->tipo_archivo }} - {{ $material->tamañoFormateado() }}</small>
                        </div>
                        <div>
                            <a href="{{ route('materiales.download', [$curso, $leccion, $material]) }}"
                                class="btn btn-sm btn-info mr-1">
                                Descargar
                            </a>
                            <form action="{{ route('materiales.destroy', [$curso, $leccion, $material]) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este material?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('materiales.index', [$curso, $leccion]) }}" class="btn btn-secondary btn-sm">Ver Todos los Materiales</a>
            </div>
            @else
            <p class="text-bg text-center mb-0">No hay materiales en esta lección</p>
            @endif
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Imagen -->
        <div class="contact-form bg-secondary rounded p-3 mb-4">
            <img src="{{ $leccion->url_imagen }}"
                alt="{{ $leccion->titulo }}"
                class="img-fluid rounded"
                style="width: 100%; height: 200px; object-fit: cover;">
        </div>

        <!-- Información -->
        <div class="contact-form bg-secondary rounded p-4 mb-4">
            <h5 class="text-bg mb-3">Información</h5>

            <div class="mb-3">
                <p class="text-bg mb-1"><strong>Orden:</strong></p>
                <p class="text-bg mb-0">Lección {{ $leccion->orden }}</p>
            </div>

            <div class="mb-3">
                <p class="text-bg mb-1"><strong>Duración:</strong></p>
                <p class="text-bg mb-0">{{ $leccion->duracion_minutos }} minutos</p>
            </div>

            <div class="mb-3">
                <p class="text-bg mb-1"><strong>Materiales:</strong></p>
                <p class="text-bg mb-0">{{ $leccion->materiales->count() }} archivo(s)</p>
            </div>

            <div>
                <p class="text-bg mb-1"><strong>Creada:</strong></p>
                <p class="text-bg mb-0">{{ $leccion->created_at->format('d/m/Y') }}</p>
            </div>
        </div>

        <!-- Acciones -->
        <div class="contact-form bg-secondary rounded p-4">
            <h5 class="text-bg mb-3">Acciones</h5>
            <a href="{{ route('lecciones.edit', [$curso, $leccion]) }}" class="btn btn-warning btn-block mb-2">Editar Lección</a>
            <form action="{{ route('lecciones.destroy', [$curso, $leccion]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta lección?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-block">Eliminar Lección</button>
            </form>
        </div>
    </div>
</div>

@endsection