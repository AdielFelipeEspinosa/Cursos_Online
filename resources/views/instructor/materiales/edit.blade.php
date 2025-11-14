@extends('layouts.instructor')

@section('title', 'Editar Material')

@section('content')

<div class="text-center mb-5">
    <h1>Editar Material</h1>
    <p class="lead text-muted">{{ $leccion->titulo }}</p>
    <p class="text-muted">Curso: {{ $curso->titulo }}</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="contact-form bg-secondary rounded p-5">
            <form method="POST" action="{{ route('materiales.update', [$curso, $leccion, $material]) }}">
                @csrf
                @method('PUT')
                
                <div class="control-group">
                    <input type="text" 
                           name="titulo" 
                           placeholder="Título del Material" 
                           class="form-control border-0 p-4" 
                           value="{{ old('titulo', $material->titulo) }}"
                           required />
                    <p class="help-block text-danger"></p>
                </div>
                
                <input type="hidden" name="tipo_archivo" id="tipo_archivo" value="">

                <div class="alert alert-info">
                    <strong>Archivo actual:</strong> {{ basename($material->archivo) }}<br>
                    <strong>Tamaño:</strong> {{ $material->tamañoFormateado() }}<br>
                    <small>Nota: No se puede cambiar el archivo, solo el título y tipo. Si necesitas cambiar el archivo, elimina este material y sube uno nuevo.</small>
                </div>
                
                <div class="text-center">
                    <button class="btn btn-primary py-3 px-5 mr-2" type="submit">Actualizar Material</button>
                    <a href="{{ route('materiales.index', [$curso, $leccion]) }}" class="btn btn-outline-dark py-3 px-5">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection