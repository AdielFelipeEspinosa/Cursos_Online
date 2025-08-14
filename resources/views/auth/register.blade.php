@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1>Rgistrar Nuevo Usuario</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form bg-secondary rounded p-5">
                    <div id="success"></div>
                    <form method="POST" action="{{ route('register') }}" name="sentMessage" id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="control-group">
                            <input type="text" name="name" placeholder="Nombre" id="subject" class="form-control border-0 p-4" required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" name="email" placeholder="Correo" class="form-control border-0 p-4" id="email" required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" name="password" placeholder="Contraseña" class="form-control border-0 p-4" id="password" required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" class="form-control border-0 p-4" id="password" required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <select name="role" required>
                            <option value="student">Estudiante</option>
                            <option value="instructor">Instructor</option>
                        </select>
                        <div class="text-center">
                            <button class="btn btn-primary py-3 px-5" type="submit" id="sendMessageButton">Registrarse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection