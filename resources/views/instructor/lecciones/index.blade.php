@extends('layouts.instructor')

@section('title', 'Gestionar Lecciones')

@section('content')

<div class="row mb-4">
    <div class="col-lg-8">
        <h1>Lecciones del Curso</h1>
        <p class="lead text-muted">{{ $curso->titulo }}</p>
    </div>
    <div class="col-lg-4 text-right">
        <a href="{{ route('lecciones.create', $curso) }}" class="btn btn-primary py-2 px-4 mr-2">Añadir Lección</a>
        <a href="{{ route('cursos.show', $curso) }}" class="btn btn-secondary py-2 px-4">Volver al Curso</a>
    </div>
</div>

@if($lecciones->count() > 0)
<div class="contact-form bg-secondary rounded p-4">
    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th style="width: 5%">Orden</th>
                    <th style="width: 30%">Título</th>
                    <th style="width: 10%">Duración</th>
                    <th style="width: 35%">Descripción</th>
                    <th style="width: 20%" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lecciones as $leccion)
                <tr>
                    <td class="align-middle">
                        <span class="badge badge-primary">{{ $leccion->orden }}</span>
                    </td>
                    <td class="align-middle">
                        <strong>{{ $leccion->titulo }}</strong>
                    </td>
                    <td class="align-middle">
                        {{ $leccion->duracion_minutos }} min
                    </td>
                    <td class="align-middle">
                        {{ Str::limit($leccion->descripcion, 80) }}
                    </td>
                    <td class="align-middle text-center">
                        <a href="{{ route('lecciones.show', [$curso, $leccion]) }}" 
                           class="btn btn-info btn-sm">
                            Ver
                        </a>
                        <a href="{{ route('lecciones.edit', [$curso, $leccion]) }}" 
                           class="btn btn-warning btn-sm">
                            Editar
                        </a>
                        <form action="{{ route('lecciones.destroy', [$curso, $leccion]) }}" 
                              method="POST" 
                              class="d-inline" 
                              onsubmit="return confirm('¿Eliminar esta lección?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="text-center">
    <div class="contact-form bg-secondary rounded p-5">
        <h4 class="text-white mb-4">No hay lecciones en este curso</h4>
        <p class="text-white mb-4">Comienza añadiendo la primera lección</p>
        <a href="{{ route('lecciones.create', $curso) }}" class="btn btn-primary py-3 px-5">Añadir Lección</a>
    </div>
</div>
@endif

@endsection