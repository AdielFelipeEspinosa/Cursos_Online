@extends('layouts.instructor')

@section('title', 'Editar Lección')

@section('content')

<div class="text-center mb-5">
    <h1>Editar Lección</h1>
    <p class="lead text-muted">{{ $curso->titulo }}</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="contact-form bg-secondary rounded p-5">
            <form method="POST" action="{{ route('lecciones.update', [$curso, $leccion]) }}">
                @csrf
                @method('PUT')
                
                <div class="control-group">
                    <input type="text" 
                           name="titulo" 
                           placeholder="Título de la Lección" 
                           class="form-control border-0 p-4" 
                           value="{{ old('titulo', $leccion->titulo) }}"
                           required />
                    <p class="help-block text-danger"></p>
                </div>
                
                <div class="control-group">
                    <textarea name="descripcion" 
                              placeholder="Descripción de la Lección" 
                              class="form-control border-0 p-4" 
                              rows="5"
                              required>{{ old('descripcion', $leccion->descripcion) }}</textarea>
                    <p class="help-block text-danger"></p>
                </div>
                
                <div class="control-group">
                    <input type="url" 
                           name="url_video" 
                           placeholder="URL del Video (YouTube)" 
                           class="form-control border-0 p-4"
                           value="{{ old('url_video', $leccion->url_video) }}"
                           required />
                    <p class="help-block text-danger"></p>
                </div>
                
                <div class="control-group">
                    <input type="url" 
                           name="url_imagen" 
                           placeholder="URL de la Imagen de Portada" 
                           class="form-control border-0 p-4"
                           value="{{ old('url_imagen', $leccion->url_imagen) }}"
                           required />
                    <p class="help-block text-danger"></p>
                </div>

                <!-- Vista previa de la imagen actual -->
                @if($leccion->url_imagen)
                <div class="control-group text-center">
                    <p class="text-white mb-2">Imagen Actual:</p>
                    <img src="{{ $leccion->url_imagen }}" 
                         alt="{{ $leccion->titulo }}" 
                         class="img-fluid rounded mb-3" 
                         style="max-width: 300px; max-height: 200px; object-fit: cover;">
                </div>
                @endif
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="control-group">
                            <input type="number" 
                                   name="duracion_minutos" 
                                   placeholder="Duración (minutos)" 
                                   class="form-control border-0 p-4"
                                   value="{{ old('duracion_minutos', $leccion->duracion_minutos) }}"
                                   min="1"
                                   required />
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="control-group">
                            <input type="number" 
                                   name="orden" 
                                   placeholder="Orden" 
                                   class="form-control border-0 p-4"
                                   value="{{ old('orden', $leccion->orden) }}"
                                   min="1"
                                   required />
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <button class="btn btn-primary py-3 px-5 mr-2" type="submit">Actualizar Lección</button>
                    <a href="{{ route('lecciones.index', $curso) }}" class="btn btn-outline-dark py-3 px-5">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection