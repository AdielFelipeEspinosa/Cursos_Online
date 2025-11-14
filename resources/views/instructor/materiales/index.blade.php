@extends('layouts.instructor')

@section('title', 'Gestionar Materiales')

@section('content')

<div class="row mb-4">
    <div class="col-lg-8">
        <h1>Materiales de la Lección</h1>
        <p class="lead text-muted">{{ $leccion->titulo }}</p>
        <p class="text-muted">Curso: {{ $curso->titulo }}</p>
    </div>
    <div class="col-lg-4 text-right">
        <a href="{{ route('materiales.create', [$curso, $leccion]) }}" class="btn btn-primary py-2 px-4 mr-2">Subir Material</a>
        <a href="{{ route('lecciones.show', [$curso, $leccion]) }}" class="btn btn-secondary py-2 px-4">Volver</a>
    </div>
</div>

@if($materiales->count() > 0)
<div class="row">
    @foreach($materiales as $material)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="contact-form bg-secondary rounded p-4">
            <div class="d-flex align-items-center mb-3">
                <i class="{{ $material->getIconoTipo() }} fa-3x mr-3"></i>
                <div>
                    <h5 class="text-bg mb-1">{{ $material->titulo }}</h5>
                    <small class="text-bg">{{ strtoupper($material->tipo_archivo) }}</small>
                </div>
            </div>
            
            <p class="text-bg mb-2">
                <strong>Tamaño:</strong> {{ $material->tamañoFormateado() }}
            </p>
            
            <p class="text-bg mb-3">
                <strong>Subido:</strong> {{ $material->created_at->format('d/m/Y') }}
            </p>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('materiales.download', [$curso, $leccion, $material]) }}" 
                   class="btn btn-info btn-sm">
                    Descargar
                </a>
                <a href="{{ route('materiales.edit', [$curso, $leccion, $material]) }}" 
                   class="btn btn-warning btn-sm">
                    Editar
                </a>
                <form action="{{ route('materiales.destroy', [$curso, $leccion, $material]) }}" 
                      method="POST" 
                      class="d-inline" 
                      onsubmit="return confirm('¿Eliminar este material?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="text-center">
    <div class="contact-form bg-secondary rounded p-5">
        <h4 class="text-bg mb-4">No hay materiales en esta lección</h4>
        <p class="text-bg mb-4">Comienza subiendo el primer material</p>
        <a href="{{ route('materiales.create', [$curso, $leccion]) }}" class="btn btn-primary py-3 px-5">Subir Material</a>
    </div>
</div>
@endif

@endsection