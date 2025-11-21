@extends('layouts.instructor')

@section('title', 'Mis Cursos')

@section('content')

<div class="text-center mb-5">
    <h1>Mis Cursos</h1>
    <a href="{{ route('cursos.create') }}" class="btn btn-primary py-3 px-5 mt-3">Crear Nuevo Curso</a>
</div>

@if($cursos->count() > 0)
<div class="row">
    @foreach($cursos as $curso)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="contact-form bg-dark rounded p-4">
            <div class="lazy-image-wrapper skeleton-loader" data-loaded="false" style="height: 200px;">
                <img
                    class="img-fluid rounded mb-3 lazy-image"
                    src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
                    data-src="{{ $curso->url_imagen }}"
                    alt="{{ $curso->titulo }}"
                    loading="lazy"
                    style="width: 100%; height: 200px; object-fit: cover;">
            </div>

            {{-- Agregar al final de la vista --}}
            {!! App\Helpers\LazyLoadHelper::renderAssets() !!}

            <h4 class="text-white mb-3">{{ $curso->titulo }}</h4>

            <p class="text-white mb-2">
                <strong>Categoría:</strong> {{ $curso->categoria->nombre }}
            </p>

            <p class="text-white mb-2">
                <strong>Estado:</strong>
                <span class="badge badge-{{ $curso->estado === 'publicado' ? 'success' : 'danger' }}">
                    {{ ucfirst($curso->estado) }}
                </span>
            </p>

            <p class="text-white mb-3">
                {{ Str::limit($curso->descripcion, 100) }}
            </p>

            <div class="d-flex justify-content-between">
                <a href="{{ route('cursos.show', $curso) }}" class="btn btn-primary btn-sm">Ver</a>
                <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('cursos.destroy', $curso) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este curso?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Paginación -->
<div class="d-flex justify-content-center mt-4">
    {{ $cursos->links() }}
</div>

@else
<div class="text-center">
    <div class="contact-form bg-dark rounded p-5">
        <h4 class="text-white mb-4">No tienes cursos creados</h4>
        <p class="text-white mb-4">Comienza creando tu primer curso</p>
        <a href="{{ route('cursos.create') }}" class="btn btn-primary py-3 px-5">Crear Curso</a>
    </div>
</div>
@endif

@endsection