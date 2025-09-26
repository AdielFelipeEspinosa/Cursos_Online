<!-- Topbar Start -->
<div class="container-fluid d-none d-lg-block">
    <div class="row align-items-center py-4 px-xl-5">

        <!-- Logo -->
        <div class="col-lg-3">
            <a href="/" class="text-decoration-none">
                <h1 class="m-0">Educa<span class="text-primary">Net</span></h1>
            </a>
        </div>

        <!-- Navbar -->
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">

                <!-- Logo responsive -->
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0"><span class="text-primary">E</span>COURSES</h1>
                </a>

                <!-- Botón responsive -->
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenido del navbar -->
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

                    <!-- Menú de navegación -->
                    <div class="navbar-nav py-0">
                        <a href="" class="nav-item nav-link active">Inicio</a>
                        <a href="" class="nav-item nav-link">Cursos</a>
                        <a href="" class="nav-item nav-link text-nowrap">Últimos Cursos</a>

                        @if(Auth::check() && Auth::user()->role === 'student')
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Soy Estudiante</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="blog.html" class="dropdown-item">Mis Cursos</a>
                                    <a href="single.html" class="dropdown-item">Mis Reseñas</a>
                                </div>
                            </div>
                        @endif

                        @if(Auth::check() && Auth::user()->role === 'instructor')
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Soy Instructor</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="blog.html" class="dropdown-item">Gestionar Cursos</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- Fin Menú de navegación -->

                    <!-- Barra de búsqueda -->
                    <form class="d-flex mx-lg-3" role="search">
                        <input class="form-control me-2 py-2 px-4 mx-2" 
                               type="search" 
                               placeholder="Buscar cursos..." 
                               aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Buscar</button>
                    </form>
                    <!-- Fin Barra de búsqueda -->

                    <!-- Botones de login / usuario -->
                    @if (Auth::check())
                        <a class="btn btn-primary py-2 px-4 mx-2 d-none d-lg-block" href="/">
                            {{ Auth::user()->name }}
                        </a>

                        <a class="btn btn-primary py-2 px-4 d-none d-lg-block"
                           href="#"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Salir
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <a class="btn btn-primary py-2 px-4 mx-2 d-none d-lg-block" href="/login">Login</a>
                        <a class="btn btn-primary py-2 px-4 d-none d-lg-block" href="/register">Registrar</a>
                    @endif
                    <!-- Fin Botones de login / usuario -->

                </div>
                <!-- Fin Contenido del navbar -->

            </nav>
        </div>
        <!-- Fin Navbar -->

    </div>
</div>
<!-- Topbar End -->
