@extends('layouts.app')

@section('title', 'Página de Inicio')

@section('content')

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Courses</h5>
            <h1>Our Popular Courses</h1>
        </div>
        <div class="row">
            @foreach($cursos as $curso)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="rounded overflow-hidden mb-2">
                    <img class="img-fluid" src="{{ $curso->url_imagen }}" alt="">
                    <div class="bg-secondary p-4">
                        <a class="h5" href="">{{ $curso->titulo }}</a>
                        <p>
                            {{ Str::limit($curso->descripcion, 100) }}
                        </p>
                        <a href="{{ route('cursos.show', $curso) }}" class="text-blue-500 mt-2 inline-block">Ver curso</a>
                        <div class="border-top mt-4 pt-4">
                            <div class="d-flex justify-content-between">
                                <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small>(250)</small></h6>
                                <h5 class="m-0">$99</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection