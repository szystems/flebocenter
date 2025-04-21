@extends('layouts.admin')
@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-clipboard2-pulse"></i>
                </div>
                <div class="page-title">
                    <h5>Evaluación Bariátrica</h5>
                </div>
            </div>
            <!-- Date range start -->
            <div class="d-flex align-items-end  d-none d-sm-block">
                <h6 class="float-end text-light" id="reloj"></h6>
            </div>
        </div>
        <!-- Main header ends -->

        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <div class="subscribe-header">
                <img src="{{ asset('dashboardtemplate/design/assets/images/bg.jpg') }}" class="img-fluid w-100" alt="Header" />
            </div>
            <div class="subscriber-body">
                <!-- Row start -->
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-12">
                        <!-- Row start -->
                        <div class="row align-items-end">
                            <a href="{{ url('show-paciente/'.$paciente->id) }}">
                                <div class="col-auto">
                                    @if ($paciente->fotografia != null)
                                        <img src="{{ asset('assets/imgs/pacientes/'.$paciente->fotografia) }}" class="img-7xx rounded-circle" />
                                    @else
                                        <img src="{{ asset('assets/imgs/pacientes/doctoricon.png') }}" class="img-7xx rounded-circle" />
                                    @endif
                                </div>
                                <div class="col">
                                    <h6>Paciente</h6>
                                    <h4 class="m-0">{{ $paciente->nombre }}</h4>
                                </div>
                            </a>
                        </div>
                        <!-- Row end -->
                    </div>
                </div>
                <!-- Row end -->

                <!-- Row start -->
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-12">
                        <div class="card light">
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                @if (count($errors)>0)
                                    <div class="alert alert-danger text-white" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="col-md-12 mb-3">
                                    <!-- Form Field Start -->
                                    <div class="mb-3">
                                        <a href="{{ url('show-paciente/'.$paciente->id) }}" class="btn btn-primary float-start m-1">
                                            <i class="bi bi-arrow-left-circle"></i> Regresar al Paciente
                                        </a>

                                        <button type="button" class="btn btn-info float-end m-1" data-bs-toggle="modal"
                                            data-bs-target="#printBariatriaModal{{ $bariatria->id }}">
                                            <i class="bi bi-printer"></i> Imprimir
                                        </button>

                                        <button type="button" class="btn btn-danger float-end m-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteBariatriaModal-{{ $bariatria->id }}">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>

                                        <button type="button" class="btn btn-warning float-end m-1" data-bs-toggle="modal"
                                            data-bs-target="#editarBariatriaModal{{ $bariatria->id }}">
                                            <i class="bi bi-pencil"></i> Editar
                                        </button>

                                        <div class="clearfix"></div>

                                        <h5 class="card-title mt-3"><u>Evaluación Bariátrica</u></h5>

                                        @include('admin.paciente.bariatria.editbariatriamodal')
                                        @include('admin.paciente.bariatria.deletebariatriamodal')
                                        @include('admin.paciente.bariatria.printmodal')
                                    </div>
                                </div>

                                <div class="row gx-3">
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Fecha de Evaluación</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ date('d/m/Y', strtotime($bariatria->fecha)) }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @if($bariatria->pdf_path)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Documento PDF</h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="{{ asset('assets/uploads/bariatria/'.$bariatria->pdf_path) }}" target="_blank" class="btn btn-primary">
                                                    <i class="bi bi-file-earmark-pdf"></i> Ver PDF
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Kilocalorias</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $bariatria->kilocalorias }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="mt-4">Datos Antropométricos</h4>
                                <div class="row gx-3">
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Peso</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $bariatria->peso }} kg</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Talla</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $bariatria->talla }} cm</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Circunferencia de Cintura</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $bariatria->cci }} cm</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Circunferencia de Cadera</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $bariatria->cca }} cm</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Circunferencia de Cuello</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $bariatria->ccu }} cm</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">IMC</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $bariatria->imc }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">ICC</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $bariatria->icc }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">ICT</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $bariatria->ict }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row gx-3 mt-4">
                                    <div class="col-md-12 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Diagnóstico</h5>
                                            </div>
                                            <div class="card-body">
                                                <div>{!! html_entity_decode($bariatria->diagnostico) !!}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="mt-2">Plan Terapéutico</h4>

                                    <div class="col-md-12 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Medicamentos</h5>
                                            </div>
                                            <div class="card-body">
                                                <div>{!! html_entity_decode($bariatria->medicamentos) !!}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Suplementación</h5>
                                            </div>
                                            <div class="card-body">
                                                <div>{!! html_entity_decode($bariatria->suplementacion) !!}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Ejercicios Recomendados</h5>
                                            </div>
                                            <div class="card-body">
                                                <div>{!! html_entity_decode($bariatria->ejercicios) !!}</div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($bariatria->comentarios)
                                    <div class="col-md-12 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Comentarios Adicionales</h5>
                                            </div>
                                            <div class="card-body">
                                                <div>{!! html_entity_decode($bariatria->comentarios) !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row end -->
            </div>
        </div>
        <!-- Content wrapper end -->
    </div>
    <!-- Content wrapper scroll end -->
@endsection
