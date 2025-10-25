<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - EducaNet Instructor</title>

    <!-- Google Fonts y librerías -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-4 shadow-sm">
        <div class="container-fluid">
            <a href="{{ route('instructor.dashboard') }}" class="navbar-brand font-weight-bold text-primary">
                Educa<span class="text-dark">Net</span> - Panel Instructor
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('instructor.dashboard') }}" class="nav-link {{ request()->routeIs('instructor.dashboard') ? 'active' : '' }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cursos.index') }}" class="nav-link {{ request()->routeIs('cursos.index') ? 'active' : '' }}">Mis Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cursos.create') }}" class="nav-link {{ request()->routeIs('cursos.create') ? 'active' : '' }}">Crear Curso</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right rounded-0 m-0">
                            <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-block btn-sm">Cerrar sesión</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="fa fa-exclamation-circle mr-2"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    @endif


    <div class="container-fluid py-5">
        <div class="container py-5">
            @yield('content')
        </div>
    </div>

    <footer>
        <div class="container-fluid bg-dark text-white py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
            <div class="row pt-5">
                <div class="col-md-12 text-center">
                    <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">EducaNet Instructor</h5>
                    <p class="mb-0">&copy; 2025 EducaNet. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>


    </footer>

</body>

</html>