@extends('layouts.instructor')

@section('title', 'Crear Lección')

@section('content')

<div class="text-center mb-5">
    <h1>Añadir Nueva Lección</h1>
    <p class="lead text-muted">{{ $curso->titulo }}</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="contact-form bg-secondary rounded p-5">
            <form method="POST" action="{{ route('lecciones.store', $curso) }}">
                @csrf
                
                <div class="control-group">
                    <input type="text" 
                           name="titulo" 
                           placeholder="Título de la Lección" 
                           class="form-control border-0 p-4" 
                           value="{{ old('titulo') }}"
                           required />
                    <p class="help-block text-danger"></p>
                </div>
                
                <div class="control-group">
                    <textarea name="descripcion" 
                              placeholder="Descripción de la Lección" 
                              class="form-control border-0 p-4" 
                              rows="5"
                              required>{{ old('descripcion') }}</textarea>
                    <p class="help-block text-danger"></p>
                </div>
                
                <div class="control-group">
                    <input type="url" 
                           name="url_video" 
                           placeholder="URL del Video (YouTube)" 
                           class="form-control border-0 p-4"
                           value="{{ old('url_video') }}"
                           required />
                    <p class="help-block text-danger"></p>
                </div>
                
                <div class="control-group">
                    <input type="url" 
                           name="url_imagen" 
                           placeholder="URL de la Imagen de Portada" 
                           class="form-control border-0 p-4"
                           value="{{ old('url_imagen') }}"
                           required />
                    <p class="help-block text-danger"></p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="control-group">
                            <input type="number" 
                                   name="duracion_minutos" 
                                   placeholder="Duración (minutos)" 
                                   class="form-control border-0 p-4"
                                   value="{{ old('duracion_minutos') }}"
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
                                   value="{{ old('orden', $siguienteOrden) }}"
                                   min="1"
                                   required />
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <button class="btn btn-primary py-3 px-5 mr-2" type="submit">Crear Lección</button>
                    <a href="{{ route('lecciones.index', $curso) }}" class="btn btn-outline-dark py-3 px-5">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection