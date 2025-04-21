@extends('layouts.admin')
@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-person"></i>
                </div>
                <div class="page-title">
                    <h5>Pacientes</h5>
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
                                @if (count($errors)>0)
                                    <div class="alert alert-danger text-white" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                @endif
                                <div class="custom-tabs-container">
                                    <ul class="nav nav-tabs" id="customTab2" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="tab-info" data-bs-toggle="tab" href="#info" role="tab"
                                                aria-controls="info" aria-selected="true">Información</a>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tab-historia" data-bs-toggle="tab" href="#historia" role="tab"
                                                aria-controls="historia" aria-selected="false">Historia</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tab-seguimiento" data-bs-toggle="tab" href="#seguimiento" role="tab"
                                                aria-controls="seguimiento" aria-selected="false">Seguimiento
                                                <span class="badge rounded-pill green ms-2">{{ $seguimientos->count() }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tab-documentos" data-bs-toggle="tab" href="#documentos" role="tab"
                                                aria-controls="documentos" aria-selected="false">Documentos<span
                                                class="badge rounded-pill green ms-2">{{ $documentos->count() }}</span></a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tab-citas" data-bs-toggle="tab" href="#citas" role="tab"
                                                aria-controls="citas" aria-selected="false">Citas<span
                                                class="badge rounded-pill green ms-2">{{ $citas->count() }}</span></a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tab-recetas" data-bs-toggle="tab" href="#recetas" role="tab"
                                                aria-controls="recetas" aria-selected="false">Recetas<span
                                                class="badge rounded-pill green ms-2">{{ $recetas->count() }}</span></a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tab-terapias" data-bs-toggle="tab" href="#terapias" role="tab"
                                                aria-controls="terapias" aria-selected="false">Terapia D. L.
                                                <span class="badge rounded-pill green ms-2">{{ $terapias->count() }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tab-bariatria" data-bs-toggle="tab" href="#bariatria" role="tab"
                                                aria-controls="bariatria" aria-selected="false">Bariatría
                                                <span class="badge rounded-pill green ms-2">{{ $bariatrias->count() }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content h-350">

                                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                                            <!-- Row start -->
                                            <div class="row gx-3">
                                                <div class="col-sm-12 col-12">
                                                    <div class="row gx-3">

                                                        <div class="col-md-12 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <h5 class="card-title"><u>Informacíon de Paciente</u></h5>
                                                                <button type="button" class="btn btn-danger float-end m-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $paciente->id }}">
                                                                    <i class="bi bi-trash"></i> Eliminar
                                                                </button>
                                                                <a href="{{ url('edit-paciente/'.$paciente->id) }}" class="btn btn-warning float-end m-1" aria-current="page"><i class="bi bi-pencil"></i> Editar</a>
                                                                <a target="_blank" href="{{ url('pdf-paciente/'.$paciente->id) }}" type="button" class="btn btn-info float-end m-1">
                                                                    <i class="bi bi-printer"></i> Imprimir
                                                                </a>
                                                                @include('admin.paciente.deletemodal')
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="fullName" class="form-label">Nombre</label>
                                                                <p>{{ $paciente->nombre }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="ocupacion" class="form-label">Ocupación</label>
                                                                <p>{{ $paciente->ocupacion }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="birthDay" class="form-label">Fecha de Nacimiento</label>
                                                                @php
                                                                    $fnacimiento = null;
                                                                    $edad = 0;
                                                                    if ($paciente->fecha_nacimiento != null) {
                                                                        $fnacimiento = date("d-m-Y", strtotime($paciente->fecha_nacimiento));
                                                                        //calcular edad
                                                                        $fecha_nacimiento = date("d-m-Y", strtotime($paciente->fecha_nacimiento));
                                                                        $cumpleanos = new DateTime($paciente->fecha_nacimiento);
                                                                        $hoy = new DateTime();
                                                                        $annos = $hoy->diff($cumpleanos);
                                                                        $edad = $annos->y;
                                                                    }

                                                                @endphp
                                                                <p>
                                                                    <strong class="text-info">{{ $fnacimiento }}</strong>
                                                                    @if ($edad > 0)
                                                                        <small>
                                                                            ({{ $edad }} años)
                                                                        </small>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="sexo" class="form-label">Sexo</label>
                                                                <p>{{ $paciente->sexo }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="contactNumber" class="form-label">Teléfono / Celular / Whatsapp</label>
                                                                <p>
                                                                    <a class="text-info" href="tel:+502{{ $paciente->telefono }}">{{ $paciente->telefono }}</a>
                                                                    @if ($paciente->celular != null)
                                                                        <a class="text-info" href="tel:+502{{ $paciente->celular }}">/ {{ $paciente->celular }}</a>
                                                                        <a class="text-success" href="https://wa.me/502{{ $paciente->celular }}" target="_blank">/ <i class="bi bi-whatsapp"></i></a>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="emailId" class="form-label">Email</label>
                                                                <p><a class="link-info" href="mailto:{{ $paciente->email }}">{{ $paciente->email }}</a></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label class="form-label">DPI</label>
                                                                <p>{{ $paciente->dpi }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label class="form-label">NIT</label>
                                                                <p>{{ $paciente->nit }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Dirección</label>
                                                                <p>{{ $paciente->direccion }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="birthDay" class="form-label">Fecha Primera Cita</label>
                                                                @php
                                                                    $fprimeracita = date("d-m-Y", strtotime($paciente->fecha_primera_cita));
                                                                @endphp
                                                                <p>
                                                                    <strong class="text-info">{{ $fprimeracita }}</strong>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="fullName" class="form-label">Enviado Por Medico</label>
                                                                <p>{{ $paciente->enviado_por_medico }}</p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Row end -->
                                        </div>

                                        <div class="tab-pane fade" id="seguimiento" role="tabpanel">
                                            <!-- Row start -->
                                            <div class="row gx-3">

                                                <h5 class="card-title"><u>Historial de Seguimientos</u></h5>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#addSeguimientoModal">
                                                    <i class="bi bi-plus-square"></i> Crear Seguimiento
                                                </button>

                                                @include('admin.paciente.seguimiento.addseguimientomodal')


                                                {{-- Acordion de Seguimientos --}}
                                                <div class="accordion" id="accordionSeguimientos">

                                                    @foreach($seguimientos as $seguimiento)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="heading{{ $seguimiento->id }}">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapse{{ $seguimiento->id }}" aria-expanded="false"
                                                                        aria-controls="collapse{{ $seguimiento->id }}">
                                                                        @php
                                                                            $fechaSeguimiento = date("d/m/Y", strtotime($seguimiento->fecha));
                                                                            // dd($fnacimiento);
                                                                        @endphp
                                                                        {{ $fechaSeguimiento }} - Dr(a).{{ $seguimiento->doctor->name }} ({{ $seguimiento->doctor->colegiado }})
                                                                </button>
                                                            </h2>
                                                            <div id="collapse{{ $seguimiento->id }}" class="accordion-collapse collapse strip"
                                                                aria-labelledby="heading{{ $seguimiento->id }}" data-bs-parent="#accordionSeguimientos">
                                                                <div class="accordion-body">
                                                                    <div class="row gx-3">

                                                                        <div class="col-md-12 mb-3">
                                                                            <!-- Form Field Start -->
                                                                            <div class="mb-3">
                                                                                <label class="descripcion"><strong>Seguimiento:</strong></label>
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        {!! html_entity_decode($seguimiento->descripcion) !!}
                                                                                    </div>
                                                                                </div>


                                                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                                                    data-bs-target="#editarSeguimientoModal{{ $seguimiento->id }}">
                                                                                    <i class="bi bi-pencil"></i> Editar
                                                                                </button>

                                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                                                    data-bs-target="#deleteseguimientoModal-{{ $seguimiento->id }}">
                                                                                    <i class="bi bi-trash"></i> Eliminar
                                                                                </button>

                                                                                <button type="button" class="btn btn-info m-1" data-bs-toggle="modal"
                                                                                    data-bs-target="#printModal{{ $seguimiento->id }}">
                                                                                    <i class="bi bi-printer"></i> Imprimir
                                                                                </button>
                                                                                @include('admin.paciente.seguimiento.printmodal')
                                                                                @include('admin.paciente.seguimiento.editarseguimientomodal')
                                                                                @include('admin.paciente.seguimiento.deleteseguimientomodal')
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>

                                            </div>
                                            <!-- Row end -->
                                        </div>

                                        <div class="tab-pane fade" id="historia" role="tabpanel">
                                            <!-- Row start -->
                                            <div class="row gx-3">

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <h5 class="card-title"><u>Información General</u></h5>

                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="col-md-3 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label for="fullName" class="form-label">Nombre</label>
                                                        <p>{{ $paciente->nombre }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label for="ocupacion" class="form-label">Ocupación</label>
                                                        <p>{{ $paciente->ocupacion }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label for="birthDay" class="form-label">Fecha de Nacimiento</label>
                                                        @php
                                                            $fnacimiento = null;
                                                            $edad = 0;
                                                            if ($paciente->fecha_nacimiento != null) {
                                                                $fnacimiento = date("d-m-Y", strtotime($paciente->fecha_nacimiento));
                                                                //calcular edad
                                                                $fecha_nacimiento = date("d-m-Y", strtotime($paciente->fecha_nacimiento));
                                                                $cumpleanos = new DateTime($paciente->fecha_nacimiento);
                                                                $hoy = new DateTime();
                                                                $annos = $hoy->diff($cumpleanos);
                                                                $edad = $annos->y;
                                                            }

                                                        @endphp
                                                        <p>
                                                            <strong class="text-info">{{ $fnacimiento }}</strong>
                                                            @if ($edad > 0)
                                                                <small>
                                                                    ({{ $edad }} años)
                                                                </small>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label for="sexo" class="form-label">Sexo</label>
                                                        <p>{{ $paciente->sexo }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label for="contactNumber" class="form-label">Teléfono / Celular / Whatsapp</label>
                                                        <p>
                                                            <a class="text-info" href="tel:+502{{ $paciente->telefono }}">{{ $paciente->telefono }}</a>
                                                            @if ($paciente->celular != null)
                                                                <a class="text-info" href="tel:+502{{ $paciente->celular }}">/ {{ $paciente->celular }}</a>
                                                                <a class="text-success" href="https://wa.me/502{{ $paciente->celular }}" target="_blank">/ <i class="bi bi-whatsapp"></i></a>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label for="emailId" class="form-label">Email</label>
                                                        <p><a class="link-info" href="mailto:{{ $paciente->email }}">{{ $paciente->email }}</a></p>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">DPI</label>
                                                        <p>{{ $paciente->dpi }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">NIT</label>
                                                        <p>{{ $paciente->nit }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Dirección</label>
                                                        <p>{{ $paciente->direccion }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label for="birthDay" class="form-label">Fecha Primera Cita</label>
                                                        @php
                                                            $fprimeracita = date("d-m-Y", strtotime($paciente->fecha_primera_cita));
                                                        @endphp
                                                        <p>
                                                            <strong class="text-info">{{ $fprimeracita }}</strong>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <h5 class="card-title"><u>Historia General</u></h5>

                                                        <a href="{{ url('edit-historia/'.$historia->paciente_id) }}" class="btn btn-warning m-1" aria-current="page"><i class="bi bi-pencil"></i> Editar</a>
                                                        <button type="button" class="btn btn-info m-1" data-bs-toggle="modal"
                                                            data-bs-target="#printModal{{ $historia->paciente_id }}">
                                                            <i class="bi bi-printer"></i> Imprimir
                                                        </button>
                                                        @include('admin.paciente.historia.printmodal')
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">¿FUE ENVIADO POR ALGUN MEDICO PARA SU VALORACION?</label>
                                                        <p>{{ $historia->medico != null ? $historia->medico : 'No' }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">MIEMBRO AFECTADO:</label>
                                                        <p>{{ $historia->miembro_afectado != null ? $historia->miembro_afectado : 'Ninguno' }}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">PESO</label>
                                                        <p>{{ $historia->peso }} Lbs.</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">ESTATURA</label>
                                                        <p>{{ $historia->estatura }} Mts.</p>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">A. ¿ACUDE A CONSULTA POR?</label>
                                                        <p>
                                                            Estetica: <strong>{{ $historia->a_estetica == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Enfermedad: <strong>{{ $historia->a_enfermedad == '1' ? 'Si' : 'No' }}</strong>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">B. ¿CUALES SON LAS MOLESTIAS QUE SIENTE EN LAS PIERNAS?</label>
                                                        <p>
                                                            Dolor en el muslo: <strong>{{ $historia->b_muslo == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Dolor en la pantorrilla: <strong>{{ $historia->b_pantorrilla == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Dolor en el tobillo: <strong>{{ $historia->b_tobillo == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            <strong>Otras:</strong>
                                                            <br>
                                                            Dolor: <strong>{{ $historia->b_varicorragia == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Hinchazon: <strong>{{ $historia->b_inchazon == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Ulceras en la piel: <strong>{{ $historia->b_ulceras_piel == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Ardor: <strong>{{ $historia->b_ardor == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Comezon: <strong>{{ $historia->b_comezon == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Cansancio: <strong>{{ $historia->b_cansancio == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Pesadez: <strong>{{ $historia->b_pesadez == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Calambres: <strong>{{ $historia->b_calambres == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            @if ($historia->b_describir)
                                                                Otros sintomas: <strong>{{ $historia->b_describir }}</strong>
                                                            @endif

                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">C. ¿EL DOLOR AUMENTA CON?</label>
                                                        <p>
                                                            Al caminar: <strong>{{ $historia->c_caminar == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Periodos prolongados de pie: <strong>{{ $historia->c_periodos_prolongados_pie == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Calor: <strong>{{ $historia->c_calor == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Menstruacion: <strong>{{ $historia->c_menstruacion == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Ejercicio: <strong>{{ $historia->c_ejercicio == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Al elevar las piernas: <strong>{{ $historia->c_elevar_piernas == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Otros: <strong>{{ $historia->c_otros == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Cuales: <strong>{{ $historia->c_cuales == null ? '' : $historia->c_cuales }}</strong>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">D. ¿EL DOLOR DISMINUYE CON?</label>
                                                        <p>
                                                            Elevacion de las piernas: <strong>{{ $historia->d_elevacion_piernas == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Medias elasticas: <strong>{{ $historia->d_medias_elasticas == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Ejercicio: <strong>{{ $historia->d_ejercicio == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Mediamientos: <strong>{{ $historia->d_mediamientos == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Cuales: <strong>{{ $historia->d_cuales == null ? '' : $historia->d_cuales }}</strong>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">E. ¿ALGUIEN EN SU FAMILIA HA PADECIDO DE?</label>
                                                        <p>
                                                            Varices: <strong>{{ $historia->e_varices == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Flebitis: <strong>{{ $historia->e_flebitis == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Ulceras o llagas en las piernas: <strong>{{ $historia->e_ulceras_llagas_piernas == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Trombosis: <strong>{{ $historia->e_trombosis == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            @if ($historia->e_quien)
                                                            ¿Quien?: <strong>{{ $historia->e_quien }}</strong>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">F. ¿TRATAMIENTOS VENOSOS PREVIOS?</label>
                                                        <p>
                                                            <strong>{{ $historia->f_tratamientos_venosos_previos == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Cuales: <strong>{{ $historia->f_cuales == null ? '' : $historia->f_cuales }}</strong>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">G. ¿ES ALERGICO A LOS MEDICAMENTOS?</label>
                                                        <p>
                                                            <strong>{{ $historia->g_alergico == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Cuales: <strong>{{ $historia->g_cuales == null ? '' : $historia->g_cuales }}</strong>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">H. ¿LE HAN REALIZADO ALGUNA CIRUGIA(S)?</label>
                                                        <p>
                                                            <textarea class="form-control border px-2 class" rows="5">{{ $historia->h_cirugias == null ? 'Ninguna' : $historia->h_cirugias }}</textarea>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">I. ¿SUFRE ALGUNA ENFERMEDAD? ¿CUALES? (DESCRIBALAS)</label>
                                                        <div class="card-body">
                                                            {{-- {!! html_entity_decode($historia->i_enfermedades) !!} --}}
                                                            {!! html_entity_decode($historia->i_enfermedades)!!}
                                                            {{-- {!! htmlspecialchars_decode(nl2br($historia->i_enfermedades))!!} --}}
                                                            {{-- {!! htmlspecialchars_decode(nl2br(strip_tags($historia->i_enfermedades, '<p><h1><h2><h3><h4><h5><h6><img><ul><ol><li>')))!!} --}}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">J. FECHA ULTIMA REGLA</label>
                                                        <p>
                                                            @php
                                                                if ($historia->j_fecha_ultima_regla != null) {
                                                                    $fur = date("d/m/Y", strtotime($historia->fur));
                                                                }
                                                            @endphp
                                                            {{ $historia->j_fecha_ultima_regla != null ? $fur : 'No definido' }}
                                                            <br>
                                                            @if ($historia->j_otro)
                                                            Otro: <strong>{{ $historia->j_otro }}</strong>
                                                            @endif
                                                            <br>
                                                            ¿Esta tomando hormonas o anticonceptivos? <strong>{{ $historia->j_hormonas_anticonceptivos == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Cuales: <strong>{{ $historia->j_cuales == null ? 'Ninguno' : $historia->j_cuales }}</strong>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">K. ¿EN SU TRABAJO REQUIERE?</label>
                                                        <p>
                                                            Estar mucho tiempo de pie: <strong>{{ $historia->k_tiempo_pie == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Estar mucho tiempo sentado: <strong>{{ $historia->k_tiempo_sentado == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Estar expuesto al calor: <strong>{{ $historia->k_expuesto_calor == '1' ? 'Si' : 'No' }}</strong>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">L. ¿USTED ACOSTUMBRA?</label>
                                                        <p>
                                                            Fumar: <strong>{{ $historia->l_fumar == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Ingerir alcohol: <strong>{{ $historia->l_alcohol == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Otros: <strong>{{ $historia->l_otros == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Cuales: <strong>{{ $historia->l_cuales == null ? '' : $historia->l_cuales }}</strong>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">M. ¿EMBARAZOS?</label>
                                                        <p>
                                                            <strong>{{ $historia->m_embarazos >= '1' ? $historia->m_embarazos : 'No' }}</strong>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">¿PROBLEMAS DURANTE SUS EMBARAZOS?</label>
                                                        <p>
                                                            {{-- <strong>{{ $historia->m_embarazos == '1' ? 'Si' : 'No' }}</strong>
                                                            <br> --}}
                                                            Cuales: <textarea class="form-control border px-2 class" rows="5">{{ $historia->m_problemas == null ? 'Ninguno' : $historia->m_problemas }}</textarea>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">N. ¿ALGUNA INFORMACION QUE CONSIDERE PERTINENTE?</label>
                                                        <p>
                                                            <textarea class="form-control border px-2 class" rows="5">{{ $historia->n_informacion_pertinente == null ? 'Ninguno' : $historia->n_informacion_pertinente }}</textarea>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">O. ¿EXPLORACION FISICA?</label>
                                                        <p>
                                                            Circunferencia MID: <div class="card-body"> {!! html_entity_decode($historia->o_circunferencia_mid) !!} </div>
                                                            <br>
                                                            Circunferencia MII: <div class="card-body"> {!! html_entity_decode($historia->o_circunferencia_mii) !!} </div>
                                                            <br>
                                                            Ulcera: <strong>{{ $historia->o_ulcera == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Edema: <strong>{{ $historia->o_edema == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Telangiectasias: <strong>{{ $historia->o_telangiectasias == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Venas de pequeño tamaño: <strong>{{ $historia->o_venas_pequeno == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Venas de mediano tamaño: <strong>{{ $historia->o_venas_mediano == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Venas de gran tamaño: <strong>{{ $historia->o_venas_gran == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Linfedema: <strong>{{ $historia->o_linfedema == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Lipodermatoesclerosis: <strong>{{ $historia->o_lipodermatoesclerosis == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Hipersensibilidad: <strong>{{ $historia->o_hipersensibilidad == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            @if ($historia->o_otros)
                                                            Otros: <strong>{{ $historia->o_otros }}</strong>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">P. ¿DIAGNOSTICO?</label>
                                                        <div class="card-body"> {!! html_entity_decode($historia->p_diagnostico) !!} </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Q. SOLICITAR DOPPLER</label>
                                                        <p>
                                                            Arterial: <strong>{{ $historia->q_arterial == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Venoso: <strong>{{ $historia->q_venoso == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            MII: <strong>{{ $historia->q_mii == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            MID: <strong>{{ $historia->q_mid == '1' ? 'Si' : 'No' }}</strong>
                                                            <br>
                                                            Bilateral: <strong>{{ $historia->q_bilateral == '1' ? 'Si' : 'No' }}</strong>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">R. RESULTADO DE DOPPLER</label>
                                                        <div class="card-body"> {!! html_entity_decode($historia->r_resultado_doppler) !!} </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <!-- Form Field Start -->
                                                    <div class="mb-3">
                                                        <label class="form-label">S. TRATAMIENTO</label>
                                                        <div class="card-body"> {!! html_entity_decode($historia->s_tratamiento) !!} </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- Row end -->
                                        </div>

                                        <div class="tab-pane fade" id="documentos" role="tabpanel">
                                            <!-- Row start -->
                                            <div class="row gx-3">

                                                <h4>Documentos</h4>
                                                <hr>

                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#addDocModal">
                                                    <i class="bi bi-plus-square"></i> Agregar Documento
                                                </button>

                                                @include('admin.paciente.documento.adddocmodal')

                                                <div class="table-responsive">
                                                    <table class="table align-middle table-striped flex-column">
                                                        <thead>
                                                            <tr>
                                                                <td align="center"><i class="bi bi-list-task"></i></td>
                                                                <td align="center">fecha / <strong>Nombre</strong></td>
                                                                <td align="center">Tipo</td>
                                                                <td align="center">Descripcion</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($documentos as $doc)
                                                            <tr>
                                                                <td align="center">

                                                                    <a type="button" class="btn btn-info m-1" href="{{ asset('assets/imgs/documentos/'.$doc->archivo) }}" target="_blank"><i class="bi bi-eye-fill text-white"></i></a>

                                                                    <button type="button" class="btn btn-warning  m-1" data-bs-toggle="modal"
                                                                        data-bs-target="#editarDocModal{{ $doc->id }}">
                                                                        <i class="bi bi-pencil"></i>
                                                                    </button>

                                                                    @if (Auth::user()->principal == 1)
                                                                        <button type="button" class="btn btn-danger  m-1" data-bs-toggle="modal" data-bs-target="#deleteDocModal-{{ $doc->id }}">
                                                                            <i class="bi bi-trash-fill text-white"></i>
                                                                        </button>
                                                                    @endif

                                                                    @include('admin.paciente.documento.editdocmodal')
                                                                    @include('admin.paciente.documento.deletedocmodal')

                                                                </td>
                                                                <td align="center">
                                                                    @php
                                                                        $fecha = date('d/m/Y', strtotime($doc->created_at));
                                                                    @endphp
                                                                    <p>{{ $fecha }} - <strong><a href="{{ asset('assets/imgs/documentos/'.$doc->archivo) }}" target="_blank" class="text-blue">{{ $doc->nombre }}</a></strong></p>
                                                                </td>
                                                                <td align="center">
                                                                    <p>{{ $doc->tipo}}</p>
                                                                </td>
                                                                <td align="center">
                                                                    <p>{{  $doc->descripcion}}</p>
                                                                </td>


                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @if ($documentos->count() == 0)
                                                        <div class="alert alert-warning text-white" role="alert">
                                                            <ul align="center">
                                                                <p>No se han ingresado documentos.</p>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    {{-- {{ $Movimientos->links() }} --}}
                                                </div>



                                            </div>
                                            <!-- Row end -->
                                        </div>

                                        <div class="tab-pane fade" id="citas" role="tabpanel">
                                            <!-- Row start -->
                                            <div class="row gx-3">

                                                <h5 class="card-title"><u>Historial de Citas</u></h5>
                                                <br>
                                                <a href="{{ url('add-cita-paciente/'.$paciente->id) }}" type="button" class="btn btn-success float-end">
                                                    <i class="bi bi-plus-square"></i> Crear Cita
                                                </a>

                                                <div class="table-responsive">
                                                    <table class="table align-middle table-striped flex-column">
                                                        <thead>
                                                            <tr>
                                                                <td align="center"><small><i class="bi bi-list-task"></i></small></td>
                                                                <td><small>Fecha / Hora</small></td>
                                                                <td><small>Estado</small></td>
                                                                <td><small>Clinica</small></td>
                                                                <td><small>Doctor</small></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($citas as $cita)
                                                            <tr>
                                                                <td align="center">
                                                                    <div class="btn-group dropend">
                                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                                                            <i class="bi bi-list-task"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                                                                            <li>
                                                                                <a class="dropdown-item" href="{{ url('show-cita/'.$cita->id) }}"><i class="bi bi-eye-fill text-blue"></i> Información</a>
                                                                            </li>
                                                                            <li>
                                                                                <a class="dropdown-item" href="{{ url('edit-cita/'.$cita->id) }}"><i class="bi bi-pencil-fill text-warning"></i> Editar</a>
                                                                            </li>
                                                                            <li>
                                                                                <a type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $cita->id }}">
                                                                                    <i class="bi bi-trash-fill text-danger"></i> Eliminar
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $fecha = date("d/m/Y", strtotime($cita->fecha_cita));
                                                                        $hi = date('h:i A', strtotime($cita->hora_inicio));
                                                                        $hf = date('h:i A', strtotime($cita->hora_fin));
                                                                    @endphp
                                                                    <small> <p class="text-blue">{{ $fecha }}</p>{{ $hi }} - {{ $hf }}</small>
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $infocita = \App\Models\Cita::find($cita->id);
                                                                    @endphp
                                                                    <small>
                                                                        <span class="badge
                                                                        shade-light-{{ $infocita->estado == "Pendiente" ? 'yellow'
                                                                                : ($infocita->estado == "Confirmada" ? 'blue'
                                                                                : ($infocita->estado == "Atendida" ? 'green'
                                                                                : ""))
                                                                            }}">
                                                                            {{ $infocita->estado }}
                                                                        </span>
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $clinica = \App\Models\Clinica::find($cita->clinica_id);
                                                                    @endphp
                                                                    <small>
                                                                        <strong>{{ $clinica->nombre }}</strong>
                                                                        <br>
                                                                        {{ $clinica->direccion }}
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $doctor = \App\Models\User::find($cita->doctor_id);
                                                                    @endphp
                                                                    <small>
                                                                        <strong><a class="text-primary" href="{{ url('show-user/'.$doctor->id) }}">{{ $doctor->name }}</a></strong>
                                                                        <br>
                                                                        <a class="text-info" href="mailto:{{ $doctor->email }}">{{ $doctor->email }}</a>
                                                                        <br>
                                                                        <a class="text-light" href="tel:+502{{ $doctor->telefono }}">{{ $doctor->telefono }}</a>
                                                                        @if ($doctor->celular != null)
                                                                        / <a class="text-light" href="tel:+502{{ $doctor->celular }}">{{ $doctor->celular }}</a>

                                                                        / <a class="text-success" href="https://wa.me/502{{ $doctor->celular }}" target="_blank"><i class="bi bi-whatsapp"></i></a>
                                                                        @endif
                                                                    </small>
                                                                </td>

                                                            </tr>
                                                            @include('admin.cita.deletemodal')
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>

                                            </div>
                                            <!-- Row end -->
                                        </div>

                                        <div class="tab-pane fade" id="recetas" role="tabpanel">
                                            <!-- Row start -->
                                            <div class="row gx-0">

                                                <h5 class="card-title"><u>Historial de Recetas</u></h5>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#addRecetaModal">
                                                    <i class="bi bi-plus-square"></i> Crear Receta
                                                </button>

                                                @include('admin.paciente.receta.addrecetamodal')


                                                {{-- Acordion de Recetas --}}
                                                <div class="accordion" id="accordionRecetas">

                                                    @foreach($recetas as $receta)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="heading{{ $receta->id }}">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapse{{ $receta->id }}" aria-expanded="false"
                                                                        aria-controls="collapse{{ $receta->id }}">
                                                                        @php
                                                                            $fechaReceta = date("d/m/Y", strtotime($receta->fecha));
                                                                            // dd($fnacimiento);
                                                                        @endphp
                                                                        {{ $fechaReceta }} - Dr(a).{{ $receta->doctor->name }} ({{ $receta->doctor->colegiado }})
                                                                </button>
                                                            </h2>
                                                            <div id="collapse{{ $receta->id }}" class="accordion-collapse collapse strip"
                                                                aria-labelledby="heading{{ $receta->id }}" data-bs-parent="#accordionRecetas">
                                                                <div class="accordion-body">
                                                                    <div class="row gx-3">

                                                                        <div class="col-md-12 mb-3">
                                                                            <!-- Form Field Start -->
                                                                            <div class="mb-3">
                                                                                <label class="descripcion"><strong>Receta:</strong></label>
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        {!! html_entity_decode($receta->descripcion) !!}
                                                                                    </div>
                                                                                </div>


                                                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                                                    data-bs-target="#editarRecetaModal{{ $receta->id }}">
                                                                                    <i class="bi bi-pencil"></i> Editar
                                                                                </button>

                                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                                                    data-bs-target="#deleterecetaModal-{{ $receta->id }}">
                                                                                    <i class="bi bi-trash"></i> Eliminar
                                                                                </button>

                                                                                <button type="button" class="btn btn-info m-1" data-bs-toggle="modal"
                                                                                    data-bs-target="#printModal{{ $receta->id }}">
                                                                                    <i class="bi bi-printer"></i> Imprimir
                                                                                </button>
                                                                                @include('admin.paciente.receta.printmodal')
                                                                                @include('admin.paciente.receta.editarrecetamodal')
                                                                                @include('admin.paciente.receta.deleterecetamodal')
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>


                                            </div>
                                            <!-- Row end -->
                                        </div>

                                        <div class="tab-pane fade" id="terapias" role="tabpanel">
                                            <!-- Row start -->
                                            <div class="row gx-3">

                                                <h4>Terapias de Drenaje Linfático</h4>
                                                <hr>

                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#addTerapiaModal">
                                                    <i class="bi bi-plus-square"></i> Agregar Terapia
                                                </button>

                                                @include('admin.paciente.terapia.addterapiamodal')

                                                <div class="table-responsive">
                                                    <table class="table align-middle table-striped flex-column">
                                                        <thead>
                                                            <tr>
                                                                <td align="center"><i class="bi bi-list-task"></i></td>
                                                                <td align="center">Inicio</td>
                                                                <td align="center">Ultima</td>
                                                                <td align="center">#S. Izquierda</td>
                                                                <td align="center">#S. Derecha</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($terapias as $terapia)
                                                            <tr>
                                                                <td align="center">

                                                                    <a type="button" class="btn btn-info m-1" href="{{ url('show-terapia/'.$terapia->id) }}"><i class="bi bi-eye-fill text-white"></i></a>

                                                                    <button type="button" class="btn btn-warning  m-1" data-bs-toggle="modal"
                                                                        data-bs-target="#editarTerapiaModal{{ $terapia->id }}">
                                                                        <i class="bi bi-pencil"></i>
                                                                    </button>

                                                                    @if (Auth::user()->principal == 1)
                                                                        <button type="button" class="btn btn-danger  m-1" data-bs-toggle="modal" data-bs-target="#deleteTerapiaModal-{{ $terapia->id }}">
                                                                            <i class="bi bi-trash-fill text-white"></i>
                                                                        </button>
                                                                    @endif

                                                                    @include('admin.paciente.terapia.editterapiamodal')
                                                                    @include('admin.paciente.terapia.deleteterapiamodal')

                                                                </td>
                                                                <td align="center">
                                                                    @php
                                                                        $fechainicio = date('d/m/Y', strtotime($terapia->created_at));
                                                                    @endphp
                                                                    <p class="text-success">{{ $fechainicio }} </p>
                                                                </td>
                                                                <td align="center">
                                                                    @php
                                                                        $fechaultima = date('d/m/Y', strtotime($terapia->updated_at));
                                                                    @endphp
                                                                    <p class="text-warning">{{ $fechaultima }} </p>
                                                                </td>
                                                                <td align="center">
                                                                    @php
                                                                        $izquierdo = \App\Models\TerapiaSesionIzquierda::where('terapia_id', $terapia->id)->count();
                                                                    @endphp
                                                                    <p>{{ $izquierdo }}</p>
                                                                </td>
                                                                <td align="center">
                                                                    @php
                                                                        $derecha = \App\Models\TerapiaSesionDerecha::where('terapia_id', $terapia->id)->count();
                                                                    @endphp
                                                                    <p>{{ $derecha }}</p>
                                                                </td>


                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @if ($terapias->count() == 0)
                                                        <div class="alert alert-warning text-white" role="alert">
                                                            <ul align="center">
                                                                <p>No se han ingresado terapias.</p>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>



                                            </div>
                                            <!-- Row end -->
                                        </div>

                                        <div class="tab-pane fade" id="bariatria" role="tabpanel">
                                            <!-- Row start -->
                                            <div class="row gx-3">

                                                <h4>Evaluaciones Bariátricas</h4>
                                                <hr>

                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#addBariatriaModal">
                                                    <i class="bi bi-plus-square"></i> Agregar Evaluación Bariátrica
                                                </button>

                                                @include('admin.paciente.bariatria.addbariatriamodal')

                                                <div class="table-responsive">
                                                    <table class="table align-middle table-striped flex-column">
                                                        <thead>
                                                            <tr>
                                                                <td align="center"><i class="bi bi-list-task"></i></td>
                                                                <td align="center">Fecha</td>
                                                                <td align="center">IMC</td>
                                                                <td align="center">Peso</td>
                                                                <td align="center">Talla</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($bariatrias as $bariatria)
                                                            <tr>
                                                                <td align="center">
                                                                    <a type="button" class="btn btn-info m-1" href="{{ url('show-bariatria/'.$bariatria->id) }}"><i class="bi bi-eye-fill text-white"></i></a>

                                                                    <button type="button" class="btn btn-warning m-1" data-bs-toggle="modal"
                                                                        data-bs-target="#editarBariatriaModal{{ $bariatria->id }}">
                                                                        <i class="bi bi-pencil"></i>
                                                                    </button>

                                                                    @if (Auth::user()->principal == 1)
                                                                        <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteBariatriaModal-{{ $bariatria->id }}">
                                                                            <i class="bi bi-trash-fill text-white"></i>
                                                                        </button>
                                                                    @endif

                                                                    @include('admin.paciente.bariatria.editbariatriamodal')
                                                                    @include('admin.paciente.bariatria.deletebariatriamodal')
                                                                </td>
                                                                <td align="center">
                                                                    @php
                                                                        $fechaBariatria = date('d/m/Y', strtotime($bariatria->fecha));
                                                                    @endphp
                                                                    <p class="text-success">{{ $fechaBariatria }}</p>
                                                                </td>
                                                                <td align="center">
                                                                    <p>{{ $bariatria->imc }}</p>
                                                                </td>
                                                                <td align="center">
                                                                    <p>{{ $bariatria->peso }} kg</p>
                                                                </td>
                                                                <td align="center">
                                                                    <p>{{ $bariatria->talla }} cm</p>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @if ($bariatrias->count() == 0)
                                                        <div class="alert alert-warning text-white" role="alert">
                                                            <ul align="center">
                                                                <p>No se han ingresado evaluaciones bariátricas.</p>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Row end -->
                                        </div>

                                    </div>
                                    {{-- <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-outline-secondary">
                                            Cancel
                                        </button>
                                        <button type="button" class="btn btn-success">
                                            Update
                                        </button>
                                    </div> --}}
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
