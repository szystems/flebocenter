@extends('layouts.admin')

@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-calendar2-week"></i>
                </div>
                <div class="page-title">
                    <h5>Citas</h5>
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



            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-sm-12 col-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="card-title">
                                @php
                                    $hoy = \Carbon\Carbon::today();
                                    $fechaSolicitudCarbon = new \Carbon\Carbon($fechaVista);
                                    $fechaFormatoLetras = $fechaSolicitudCarbon->locale('es')->isoFormat('D [de] MMMM [de] YYYY');
                                @endphp
                                <p>Listado de Citas: <h1> <strong class="text-info">@if($fechaSolicitudCarbon->isSameDay($hoy)) (Hoy)  @endif</strong> <Strong class="text-blue">{{ $fechaFormatoLetras }}</Strong></h1></p>

                            </div>

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
                            <button type="button" class="btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#printCitasModal">
                                <i class="bi bi-printer"></i> Imprimir
                            </button>

                            @include('admin.cita.printcitasmodal')
                            <div class="table-responsive">
                                <table class="table align-middle table-striped flex-column">
                                    <thead>
                                        <tr>
                                            <td align="center"><i class="bi bi-list-task"></i></td>
                                            <td>Hora</td>
                                            <td>Estado</td>
                                            <td>Clinica</td>
                                            <td>Doctor</td>
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
                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Content wrapper end -->

    </div>
    <!-- Content wrapper scroll end -->
@endsection

