@extends('layouts.admin')
@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-shield-plus"></i>
                </div>
                <div class="page-title">
                    <h5>Doctores</h5>
                </div>
            </div>
            <!-- Date range start -->
            <div class="d-flex align-items-end d-none d-sm-block">
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
                            <div class="col-auto">
                                @if ($user->fotografia != null)
                                    <img src="{{ asset('assets/imgs/users/'.$user->fotografia) }}" class="img-7xx rounded-circle" />
                                @else
                                    <img src="{{ asset('assets/imgs/users/doctoricon.png') }}" class="img-7xx rounded-circle" />
                                @endif
                            </div>
                            <div class="col">
                                <h6>Doctor</h6>
                                <h4 class="m-0">{{ $user->name }}</h4>
                            </div>
                            <div class="col-12 col-md-auto">
                                <div class="btn-group-sm m-3">
                                    <a target="_blank" href="{{ url('pdf-doctor/'.$user->id) }}" type="button" class="btn btn-info">
                                        <i class="bi bi-printer"></i> Imprimir
                                    </a>
                                    <a href="{{ url('edit-user/'.$user->id) }}" class="btn btn-warning" aria-current="page"><i class="bi bi-pencil"></i> Editar</a>
                                    @if ($user->principal == "1")
										<button disabled type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $user->id }}">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $user->id }}">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    @endif

                                    @include('admin.user.deletemodal')
                                </div>
                            </div>
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
                                <div class="custom-tabs-container">
                                    <ul class="nav nav-tabs" id="customTab2" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="tab-docInfo" data-bs-toggle="tab" href="#docInfo" role="tab"
                                                aria-controls="docInfo" aria-selected="true">Información</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tab-docCitas" data-bs-toggle="tab" href="#docCitas" role="tab"
                                                aria-controls="docCitas" aria-selected="false">
                                                Citas
                                                <span class="badge rounded-pill green ms-2">Hoy ({{ $citas->count() }})</span></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content h-350">

                                        <div class="tab-pane fade show active" id="docInfo" role="tabpanel">
                                            <!-- Row start -->
                                            <div class="row gx-3">
                                                <div class="col-sm-12 col-12">
                                                    <div class="row gx-3">

                                                        <div class="col-md-4 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="fullName" class="form-label">Nombre</label>
                                                                <p>{{ $user->name }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="birthDay" class="form-label">Fecha de Nacimiento</label>
                                                                @php
                                                                    $fnacimiento = null;
                                                                    $edad = 0;
                                                                    if ($user->fecha_nacimiento != null) {
                                                                        $fnacimiento = date("d-m-Y", strtotime($user->fecha_nacimiento));
                                                                        //calcular edad
                                                                        $fecha_nacimiento = date("d-m-Y", strtotime($user->fecha_nacimiento));
                                                                        $cumpleanos = new DateTime($user->fecha_nacimiento);
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

                                                        <div class="col-md-4 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="emailId" class="form-label">Email</label>
                                                                <p><a class="link-info" href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="contactNumber" class="form-label">Teléfono / Celular / Whatsapp</label>
                                                                <p>
                                                                    <a class="text-info" href="tel:+502{{ $user->telefono }}">{{ $user->telefono }}</a>
                                                                    @if ($user->celular != null)
                                                                        <a class="text-info" href="tel:+502{{ $user->celular }}">/ {{ $user->celular }}</a>
                                                                        <a class="text-success" href="https://wa.me/502{{ $user->celular }}" target="_blank">/ <i class="bi bi-whatsapp"></i></a>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-4 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Dirección</label>
                                                                <p>{{ $user->direccion }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label class="form-label">No. Colegiado</label>
                                                                <p>{{ $user->colegiado }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Descripción</label>
                                                                <p>{{ $user->descripcion }}</p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Row end -->
                                        </div>

                                        <div class="tab-pane fade" id="docCitas" role="tabpanel">
                                            <div class="card-body">
                                                <!-- Row start -->
                                                <div class="row gx-3">

                                                    <div class="col-sm-12 col-12">
                                                        <!-- Card start -->
                                                        <div class="card">
                                                            <div class="card-header">
                                                                @php
                                                                    $hoy = \Carbon\Carbon::today();
                                                                    $fechaSolicitudCarbon = new \Carbon\Carbon($fechaVista);
                                                                    $fechaFormatoLetras = $fechaSolicitudCarbon->locale('es')->isoFormat('D [de] MMMM [de] YYYY');
                                                                @endphp
                                                                <p>Listado de Citas: <h1> <strong class="text-info">@if($fechaSolicitudCarbon->isSameDay($hoy)) (Hoy)  @endif</strong> <Strong class="text-blue">{{ $fechaFormatoLetras }}</Strong></h1></p>
                                                            </div>
                                                            <div class="card-body">
                                                                @include('admin.cita.search')
                                                                <p class="m-0 fw-normal">
                                                                    <hr>
                                                                    <a href="{{ url('add-cita') }}" type="button" class="btn btn-success float-end">
                                                                        <i class="bi bi-plus-square"></i> Crear Cita
                                                                    </a>
                                                                    <strong><u>Filtros:</u></strong>
                                                                    <br>
                                                                    <small>
                                                                        @if ($fechaVista)
                                                                            <strong>Fecha: </strong><font color="Blue">{{ $fechaVista }} @if($fechaSolicitudCarbon->isSameDay($hoy)) (Hoy)  @endif</font>
                                                                        @endif
                                                                        @if (request('festado'))
                                                                            <strong>Estado:  </strong><font color="Blue">{{ request('festado') }}</font>
                                                                        @endif
                                                                        @if (request('fclinica'))
                                                                            @php
                                                                                $clinica = \App\Models\Clinica::find(request('fclinica'));
                                                                            @endphp
                                                                            <strong>Clinica:  </strong><font color="Blue">{{ $clinica->nombre }}</font>
                                                                        @endif
                                                                        @if (request('fdoctor'))
                                                                            @php
                                                                                $doctor = \App\Models\User::find(request('fdoctor'));
                                                                            @endphp
                                                                            <strong>Doctor:  </strong><font color="Blue">{{ $doctor->name }}</font>
                                                                        @endif
                                                                        @if (request('fpaciente'))
                                                                            <strong>Paciente:  </strong><font color="Blue">{{ request('fpaciente') }}</font>
                                                                        @endif
                                                                    </small>
                                                                </p>
                                                                <div class="table-responsive">
                                                                    <table class="table align-middle table-striped flex-column">
                                                                        <thead>
                                                                            <tr>
                                                                                <td align="center"><i class="bi bi-list-task"></i></td>
                                                                                <td>Hora</td>
                                                                                <td>Estado</td>
                                                                                <td>Clinica</td>
                                                                                {{-- <td>Doctor</td> --}}
                                                                                <td>Paciente</td>
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
                                                                                        $hi = date('h:i A', strtotime($cita->hora_inicio));
                                                                                        $hf = date('h:i A', strtotime($cita->hora_fin));
                                                                                    @endphp
                                                                                    <small>{{ $hi }} - {{ $hf }}</small>
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
                                                                                {{-- <td>
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
                                                                                </td> --}}
                                                                                <td>
                                                                                    <div class="d-flex align-items-center">
                                                                                        {{-- @if ($user->fotografia != null)
                                                                                            <img src="{{ asset('assets/imgs/users/'.$user->fotografia) }}" class="img-4x rounded-5 me-3" alt="Doctores" />
                                                                                        @else
                                                                                            <img src="{{ asset('assets/imgs/users/doctoricon.png') }}" class="img-4x rounded-5 me-3" alt="Doctores" />
                                                                                        @endif --}}
                                                                                        @php
                                                                                            $paciente = \App\Models\Paciente::find($cita->paciente_id);
                                                                                        @endphp
                                                                                        <p class="m-0">
                                                                                            <small>
                                                                                                <a class="text-primary" href="{{ url('show-paciente/'.$paciente->id) }}"><b>{{ $paciente->nombre }}</b></a>
                                                                                                <br>
                                                                                                DPI: {{ $paciente->dpi }}
                                                                                                <br>
                                                                                                <a class="text-info" href="mailto:{{ $paciente->email }}">{{ $paciente->email }}</a>
                                                                                                <br>
                                                                                                <a class="text-light" href="tel:+502{{ $paciente->telefono }}">{{ $paciente->telefono }}</a>
                                                                                                @if ($paciente->celular != null)
                                                                                                / <a class="text-light" href="tel:+502{{ $paciente->celular }}">{{ $paciente->celular }}</a>

                                                                                                / <a class="text-success" href="https://wa.me/502{{ $paciente->celular }}" target="_blank"><i class="bi bi-whatsapp"></i></a>
                                                                                                @endif
                                                                                            </small>

                                                                                        </p>

                                                                                    </div>
                                                                                </td>

                                                                            </tr>
                                                                            @include('admin.cita.deletemodal')
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                    {{-- {{ $citas->links() }} --}}
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- Card end -->
                                                    </div>

                                                </div>
                                                <!-- Row end -->
                                            </div>
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
