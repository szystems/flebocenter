@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <!-- Login Start-->
    <div class="container-fluid bg-offer my-5 py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 wow zoomIn" data-wow-delay="0.6s">
                    <div class="appointment-form h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s">
                        <h1 class="text-white mb-4">Iniciar Sesión</h1>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row g-3">
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        @error('email')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <input type="email" id="email" class="form-control bg-light border-0" placeholder="Tu Correo" style="height: 55px;" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        @error('password')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <input id="password" type="password" class="form-control bg-light border-0" placeholder="Tu Contraseña" style="height: 55px;" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12" align="left">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label text-light">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div><!-- End .custom-checkbox -->

                                <div class="col-12">
                                    <button class="btn btn-dark w-100 py-3" type="submit">Entrar</button>
                                </div>

                                <div class="col-12 col-sm-12" align="left">
                                    <a class="btn btn-link text-light" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                </div><!-- End .custom-checkbox -->

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login End -->
@endsection
