@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1>Login</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form bg-secondary rounded p-5">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="control-group">
                            <input type="email" name="email" placeholder="Correo" class="form-control border-0 p-4" id="email" required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" name="password" placeholder="Contraseña" class="form-control border-0 p-4" id="password" required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary py-3 px-5" type="submit" id="sendMessageButton">Iniciar Sesion</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection