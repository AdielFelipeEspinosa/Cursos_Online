@extends('layouts.instructor')

@section('title', 'Editar Curso')

@section('content')

<div class="text-center mb-5">
    <h1>Editar Curso</h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="contact-form bg-secondary rounded p-5">
            <form method="POST" action="{{ route('cursos.update', $curso) }}">
                @csrf
                @method('PUT')
                
                <div class="control-group">
                    <input type="text" 
                           name="titulo" 
                           placeholder="Título del Curso" 
                           class="form-control border-0 p-4" 
                           value="{{ old('titulo', $curso->titulo) }}"
                           required />
                    <p class="help-block text-danger"></p>
                </div>
                
                <div class="control-group">
                    <textarea name="descripcion" 
                              placeholder="Descripción del Curso" 
                              class="form-control border-0 p-4" 
                              rows="5"
                              required>{{ old('descripcion', $curso->descripcion) }}</textarea>
                    <p class="help-block text-danger"></p>
                </div>
                
                <div class="control-group">
                    <select name="categoria_id" 
                            class="form-control border-0 p-4"
                            required>
                        <option value="">Seleccionar Categoría</option>
                        @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" 
                            {{ old('categoria_id', $curso->categoria_id) == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                        @endforeach
                    </select>
                    <p class="help-block text-danger"></p>
                </div>
                
                <div class="control-group">
                    <input type="url" 
                           name="url_imagen" 
                           placeholder="URL de la Imagen del Curso" 
                           class="form-control border-0 p-4"
                           value="{{ old('url_imagen', $curso->url_imagen) }}"
                           required />
                    <p class="help-block text-danger"></p>
                </div>

                <!-- Vista previa de la imagen actual -->
                @if($curso->url_imagen)
                <div class="control-group text-center">
                    <p class="text-dark mb-2">Imagen Actual:</p>
                    <img src="{{ $curso->url_imagen }}" 
                         alt="{{ $curso->titulo }}" 
                         class="img-fluid rounded mb-3" 
                         style="max-width: 300px; max-height: 200px; object-fit: cover;">
                </div>
                @endif
                
                <div class="text-center">
                    <button class="btn btn-primary py-3 px-5 mr-2" type="submit">Actualizar Curso</button>
                    <a href="{{ route('cursos.index') }}" class="btn btn-outline-dark py-3 px-5">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection