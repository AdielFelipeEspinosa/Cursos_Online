<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Mi Aplicación')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Bootstrap --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- Estilos principales --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    {{-- Header --}}
    @include('layouts.header')

    {{-- Navbar --}}
    @include('layouts.navbar')


    {{-- Contenido dinámico --}}

        @yield('content')
        
        
    {{-- Footer --}}
    @include('layouts.footer')
    
</body>
</html>
