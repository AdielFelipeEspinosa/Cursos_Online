@extends('layouts.instructor')

@section('title', 'Crear Curso')

@section('content')

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1>Crear Nuevo Curso</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form bg-secondary rounded p-5">
                    <div id="success"></div>

                    <form method="POST" action="{{ route('cursos.store') }}" name="sentMessage" id="contactForm" novalidate="novalidate">
                        @csrf

                        <div class="control-group mb-3">
                            <input type="text"
                                name="titulo"
                                placeholder="Título del Curso"
                                class="form-control border-0 p-4"
                                value="{{ old('titulo') }}"
                                required="required"
                                data-validation-required-message="Por favor ingrese el título del curso" />
                            <p class="help-block text-danger"></p>
                        </div>

                        <div class="control-group mb-3">
                            <textarea name="descripcion"
                                placeholder="Descripción del Curso"
                                class="form-control border-0 p-4"
                                rows="5"
                                required="required"
                                data-validation-required-message="Por favor ingrese la descripción del curso">{{ old('descripcion') }}</textarea>
                            <p class="help-block text-danger"></p>
                        </div>

                        <div class="control-group mb-3">
                            <select name="categoria_id"
                                class="form-control border-0 p-4 text-dark"
                                required="required"
                                data-validation-required-message="Por favor seleccione una categoría">
                                <option value="">Seleccionar Categoría</option>
                                @foreach($categorias as $categoria)
                                <option class=""
                                    value="{{ $categoria->id }}"
                                    {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                                @endforeach
                            </select>
                            <p class="help-block text-danger"></p>
                        </div>

                        <div class="control-group mb-4">
                            <input type="url"
                                name="url_imagen"
                                placeholder="URL de la Imagen del Curso"
                                class="form-control border-0 p-4"
                                value="{{ old('url_imagen') }}"
                                required="required"
                                data-validation-required-message="Por favor ingrese la URL de la imagen del curso" />
                            <p class="help-block text-danger"></p>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary py-3 px-5 mr-2" type="submit" id="sendMessageButton">
                                Crear Curso
                            </button>
                            <a href="{{ route('cursos.index') }}" class="btn btn-outline-dark py-3 px-5">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection