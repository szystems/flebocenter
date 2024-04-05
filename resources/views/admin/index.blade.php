@extends('layouts.admin')

@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-house"></i>
                </div>
                <div class="page-title d-none d-md-block">
                    @php
                        $usuario = Auth::user()->name;
                        $nombre = explode(' ', trim($usuario));
                    @endphp
                    <h6>Hola!<strong> {{ ucwords($nombre[0]) }}</strong></h6>
                    {{-- <p class="float-end" id="reloj"></p> --}}
                </div>
            </div>
            <!-- Date range start -->
            <div class="d-flex align-items-end">
                <h6 class="float-end text-light" id="reloj"></h6>
            </div>
            <!-- Date range end -->
        </div>
        <!-- Main header ends -->

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row gx-3">

                {{-- <div class="col-xxl-3 col-sm-6 col-12">
                    <a href="{{ url('/dashboard') }}">
                    <div class="stats-tile d-flex align-items-center position-relative tile-blue">
                        <div class="sale-icon icon-box xl rounded-5 me-3">
                            <i class="bi bi-house-fill font-2x text-blue"></i>
                        </div>
                        <div class="sale-details">
                            <h5 class="text-light"><u>Panel de Control</u></h5>
                            <h3>296</h3>
                        </div>
                        <div class="tile-count d-flex align-items-center justify-content-center flex-column fw-bold blue">
                            <i class="bi bi-arrow-up-circle-fill font-1x"></i>
                            <span>100%</span>
                        </div>
                    </div>
                    </a>
                </div> --}}

                <div class="col-xxl-3 col-sm-6 col-12">
                    <a href="{{ url('/') }}">
                        <div class="stats-tile d-flex align-items-center position-relative tile-blue">
                            <div class="sale-icon icon-box xl rounded-5 me-3">
                                <i class="bi bi-globe font-2x text-blue"></i>
                            </div>
                            <div class="sale-details">
                                <h5 class="text-light"><u>Sitio Web</u></h5>
                                {{-- <h3>368</h3> --}}
                            </div>
                            <div class="tile-count d-flex align-items-center justify-content-center flex-column fw-bold blue">
                                {{-- <i class="bi bi-arrow-up-circle-fill font-1x"></i>
                                <span>5%</span> --}}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-sm-6 col-12">
                    <a href="{{ url('citas') }}">
                        <div class="stats-tile d-flex align-items-center position-relative tile-green">
                            <div class="sale-icon icon-box xl rounded-5 me-3">
                                <i class="bi bi-calendar2-week font-2x text-green"></i>
                            </div>
                            <div class="sale-details">
                                <h5 class="text-light"><u>Citas</u></h5>
                                {{-- <h3>725</h3> --}}
                            </div>
                            <div class="tile-count d-flex align-items-center justify-content-center flex-column fw-bold green">
                                {{-- <i class="bi bi-arrow-up-circle-fill font-1x"></i>
                                <span>7%</span> --}}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-sm-6 col-12">
                    <a href="{{ url('pacientes') }}">
                        <div class="stats-tile d-flex align-items-center position-relative tile-green">
                            <div class="sale-icon icon-box xl rounded-5 me-3">
                                <i class="bi bi-person font-2x text-green"></i>
                            </div>
                            <div class="sale-details">
                                <h5 class="text-light"><u>Pacientes</u></h5>
                                {{-- <h3>95%</h3> --}}
                            </div>
                            <div class="tile-count d-flex align-items-center justify-content-center flex-column fw-bold green">
                                {{-- <i class="bi bi-arrow-down-circle-fill font-1x"></i>
                                <span>9%</span> --}}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-sm-6 col-12">
                    <a href="{{ url('users') }}">
                        <div class="stats-tile d-flex align-items-center position-relative tile-red">
                            <div class="sale-icon icon-box xl rounded-5 me-3">
                                <i class="bi bi-shield-plus font-2x text-red"></i>
                            </div>
                            <div class="sale-details">
                                <h5 class="text-light"><u>Doctores</u></h5>
                                {{-- <h3>95%</h3> --}}
                            </div>
                            <div class="tile-count d-flex align-items-center justify-content-center flex-column fw-bold red">
                                {{-- <i class="bi bi-arrow-down-circle-fill font-1x"></i>
                                <span>9%</span> --}}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-sm-6 col-12">
                    <a href="{{ url('asistentes') }}">
                        <div class="stats-tile d-flex align-items-center position-relative tile-red">
                            <div class="sale-icon icon-box xl rounded-5 me-3">
                                <i class="bi bi-person-workspace font-2x text-red"></i>
                            </div>
                            <div class="sale-details">
                                <h5 class="text-light"><u>Asistentes</u></h5>
                                {{-- <h3>95%</h3> --}}
                            </div>
                            <div class="tile-count d-flex align-items-center justify-content-center flex-column fw-bold red">
                                {{-- <i class="bi bi-arrow-down-circle-fill font-1x"></i>
                                <span>9%</span> --}}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-sm-6 col-12">
                    <a href="{{ url('clinicas') }}">
                        <div class="stats-tile d-flex align-items-center position-relative tile-red">
                            <div class="sale-icon icon-box xl rounded-5 me-3">
                                <i class="bi bi-hospital font-2x text-red"></i>
                            </div>
                            <div class="sale-details">
                                <h5 class="text-light"><u>Clínicas</u></h5>
                                {{-- <h3>95%</h3> --}}
                            </div>
                            <div class="tile-count d-flex align-items-center justify-content-center flex-column fw-bold red">
                                {{-- <i class="bi bi-arrow-down-circle-fill font-1x"></i>
                                <span>9%</span> --}}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Content wrapper end -->

    </div>
    <!-- Content wrapper scroll end -->
@endsection
