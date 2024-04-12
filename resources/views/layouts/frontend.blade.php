<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Flebo Center</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="assets/imgs/logos/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontendtemplate/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontendtemplate/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontendtemplate/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontendtemplate/lib/twentytwenty/twentytwenty.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontendtemplate/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontendtemplate/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-dark m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-light ps-5 pe-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <small class="py-2"><i class="far fa-clock text-primary me-2"></i>Lun-Vie: 9:00am-6:00pm, Sab: 9:00am-1:00pm</small>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-end">
                <div class="position-relative d-inline-flex align-items-center bg-primary text-white top-shape px-5">
                    <div class="me-3 pe-3 border-end py-2">
                        <p class="m-0"><i class="fa fa-envelope-open me-2"></i><a class="text-white" href="mailto:info@flebocenter.com">info@flebocenter.com</a></p>
                    </div>
                    <div class="py-2">
                        <p class="m-0"><i class="fa fa-phone-alt me-2"></i><a class="text-white" href="tel:+50277677954">7767 7954</a> - <a class="text-white" href="tel:+50257358668">5735 8668</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
        <a href="{{ url('/') }}" class="navbar-brand p-0">
            <img class="img-fluid" src="{{ asset('frontendtemplate/img/logo/logo.png') }}" alt="">
        </a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>


        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ url('/') }}" class="nav-item nav-link active">Inicio</a>
                <a href="{{ url('about-us') }}" class="nav-item nav-link">Nosotros</a>
                {{-- <a href="about-us" class="nav-item nav-link">Servicios</a> --}}
                <a href="{{ url('contact') }}" class="nav-item nav-link">Contacto</a>
                <div class="nav-item dropdown">
                    @if (Auth::guest())
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user"></i></a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route('login') }}" class="dropdown-item">Iniciar Sesion</a>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="dropdown-item">¿Olvidaste tu contraseña?</a>
                            @endif
                        </div>
                    @else
                        @php
                            $usuario = Auth::user()->name; $nombre = explode(' ',trim($usuario));
                        @endphp
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user"></i> {{ ucwords($nombre[0]) }}</a>
                        <div class="dropdown-menu m-0">
                            <a href="#" class="dropdown-item">Mi Perfil</a>
                            <a href="{{ url('dashboard') }}" class="dropdown-item">Panel de Control</a>
                            <a href="javascript:; {{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Cerrar Sesion</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endif

                </div>
            </div>
            {{-- <button type="button" class="btn text-dark" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button> --}}
            <a href="https://wa.me/50257358668" class="btn btn-primary py-2 px-4 ms-3">Programar Cita</a>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->


    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light py-5 wow fadeInUp" data-wow-delay="0.3s" style="margin-top: -75px;">
        <div class="container pt-5">
            <div class="row g-5 pt-4">
                <div class="col-lg-4 col-md-6">
                    <h3 class="text-white mb-4">Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="{{ url('/') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Inicio</a>
                        <a class="text-light mb-2" href="{{ url('about-us') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Nosotros</a>
                        {{-- <a class="text-light mb-2" href="{{  }}"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a> --}}
                        <a class="text-light" href="{{ url('contact') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Contacto</a>
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Popular Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                        <a class="text-light" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                    </div>
                </div> --}}
                <div class="col-lg-4 col-md-6">
                    <h3 class="text-white mb-4">Contacto</h3>
                    <p class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i><a class="text-white" href="https://maps.app.goo.gl/DzYtiBfeCvPWS8rE6">Condado Santa María, <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edificio Imperia, <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3er. Nivel, Clínica 6.</a></p>
                    <p class="mb-2"><i class="bi bi-envelope-open text-primary me-2"></i>info@flebocenter.com</p>
                    <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i><a class="text-white" href="tel:+50277677954">7767 7954</a> - <a class="text-white" href="tel:+50257358668">5735 8668</a></p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h3 class="text-white mb-4">Síguenos </h3>
                    <div class="d-flex">
                        {{-- <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" target="_blank" href="#"><i class="fab fa-twitter fw-normal"></i></a> --}}
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" target="_blank" href="https://www.facebook.com/flebocenterQuetzaltenango/"><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" target="_blank" href="https://wa.me/50257358668"><i class="fab fa-whatsapp fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded" target="_blank" href="https://www.instagram.com/flebocenter_quetzaltenango/?utm_source=qr&igsh=OXAyZDl6Zjh1OHh4"><i class="fab fa-instagram fw-normal"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-light py-4" style="background: #051225;">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-white border-bottom" href="https://flebocenter.com">Flebo Center</a>. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Diseñado por <a class="text-white border-bottom" href="https://szystems.com">Szystems</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontendtemplate/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('frontendtemplate/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontendtemplate/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontendtemplate/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontendtemplate/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('frontendtemplate/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('frontendtemplate/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('frontendtemplate/lib/twentytwenty/jquery.event.move.js') }}"></script>
    <script src="{{ asset('frontendtemplate/lib/twentytwenty/jquery.twentytwenty.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('frontendtemplate/js/main.js') }}"></script>

    {{-- sweet alert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
</body>

</html>


