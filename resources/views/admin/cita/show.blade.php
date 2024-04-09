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
                        <div class="card-body">
                            <div class="custom-tabs-container">
                                <div class="col-12 col-md-auto float-end">
                                    <div class="btn-group-sm m-3">
                                        <a href="{{ url('edit-cita/'.$cita->id) }}" class="btn btn-warning" aria-current="page"><i class="bi bi-pencil"></i> Editar</a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $cita->id }}">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                        @include('admin.cita.deletemodal')
                                    </div>
                                </div>
                                <ul class="nav nav-tabs" id="customTab2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                                            aria-controls="oneA" aria-selected="true">Información de Cita</a>
                                    </li>
                                </ul>
                                <div class="tab-content h-350">
                                    <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                                        <!-- Row start -->
                                        <div class="row gx-3">
                                            <div class="col-sm-12 col-12">
                                                <div class="row gx-3">

                                                    <div class="col-md-4 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="fullName" class="form-label">Fecha / Hora</label>
                                                            <p class="text-secondary">
                                                                @php
                                                                    $fecha = date("d/m/Y", strtotime($cita->fecha_cita));
                                                                    $hi = date('H:i A', strtotime($cita->hora_inicio));
                                                                    $hf = date('H:i A', strtotime($cita->hora_final));
                                                                @endphp
                                                                <strong class="text-info">{{ $fecha }}</strong> {{ $hi }} - {{ $hf }}

                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="fullName" class="form-label">Estado</label>
                                                            <p>
                                                                <span class="badge
                                                                shade-light-{{ $cita->estado == "Pendiente" ? 'yellow'
                                                                        : ($cita->estado == "Confirmada" ? 'blue'
                                                                        : ($cita->estado == "Atendida" ? 'green'
                                                                        : ""))
                                                                    }}">
                                                                    {{ $cita->estado }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="col-md-4 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="fullName" class="form-label">Clinica</label>
                                                            <p>
                                                                {{ $cita->clinica->nombre }}
                                                                <br>
                                                                <small class="text-blue">
                                                                    <a class="text-info" href="mailto:{{ $cita->clinica->email }}">{{ $cita->clinica->email }}</a>
                                                                    <a class="text-light" href="tel:+502{{ $cita->clinica->telefono }}">{{ $cita->clinica->telefono }}</a>
                                                                    @if ($cita->clinica->celular != null)
                                                                    / <a class="text-light" href="tel:+502{{ $cita->clinica->celular }}">{{ $cita->clinica->celular }}</a>

                                                                    / <a class="text-success" href="https://wa.me/502{{ $cita->clinica->celular }}" target="_blank"><i class="bi bi-whatsapp"></i></a>
                                                                    @endif
                                                                    <br>
                                                                    {{ $cita->clinica->direccion }}
                                                                </small>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="fullName" class="form-label">Doctor</label>
                                                            <p>
                                                                @if ($cita->doctor->fotografia != null)
                                                                    <img src="{{ asset('assets/imgs/users/'.$cita->doctor->fotografia) }}" class="img-4x rounded-5 me-3" alt="Pacientes" />
                                                                @else
                                                                    <img src="{{ asset('assets/imgs/users/doctoricon.png') }}" class="img-4x rounded-5 me-3" alt="Pacientes" />
                                                                @endif
                                                                {{ $cita->doctor->name }}
                                                                <br>
                                                                <small class="text-blue">
                                                                    Email: <a class="text-info" href="mailto:{{ $cita->paciente->email }}">{{ $cita->paciente->email }}</a>
                                                                    <br>
                                                                    Teléfonos:<a class="text-light" href="tel:+502{{ $cita->paciente->telefono }}">{{ $cita->paciente->telefono }}</a>
                                                                    @if ($cita->paciente->celular != null)
                                                                    / <a class="text-light" href="tel:+502{{ $cita->paciente->celular }}">{{ $cita->paciente->celular }}</a>

                                                                    / <a class="text-success" href="https://wa.me/502{{ $cita->paciente->celular }}" target="_blank"><i class="bi bi-whatsapp"></i></a>
                                                                    @endif
                                                                </small>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="fullName" class="form-label">Paciente</label>
                                                            <p>
                                                                <a class="text-primary" href="{{ url('show-paciente/'.$cita->paciente->id) }}">
                                                                @if ($cita->paciente->fotografia != null)
                                                                    <img src="{{ asset('assets/imgs/pacientes/'.$cita->paciente->fotografia) }}" class="img-4x rounded-5 me-3" alt="Pacientes" />
                                                                @else
                                                                    <img src="{{ asset('assets/imgs/pacientes/doctoricon.png') }}" class="img-4x rounded-5 me-3" alt="Pacientes" />
                                                                @endif
                                                                    {{ $cita->paciente->nombre }}
                                                                </a>
                                                                <br>
                                                                <small class="text-blue">
                                                                    DPI: {{ $cita->paciente->dpi }}
                                                                    <br>
                                                                    Email: <a class="text-info" href="mailto:{{ $cita->paciente->email }}">{{ $cita->paciente->email }}</a>
                                                                    <br>
                                                                    Teléfonos: <a class="text-light" href="tel:+502{{ $cita->paciente->telefono }}">{{ $cita->paciente->telefono }}</a>
                                                                    @if ($cita->paciente->celular != null)
                                                                    / <a class="text-light" href="tel:+502{{ $cita->paciente->celular }}">{{ $cita->paciente->celular }}</a>

                                                                    / <a class="text-success" href="https://wa.me/502{{ $cita->paciente->celular }}" target="_blank"><i class="bi bi-whatsapp"></i></a>
                                                                    @endif
                                                                </small>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="fullName" class="form-label">Fecha / Hora</label>
                                                            <textarea readonly class="form-control" rows="3">{{ $cita->motivo }}</textarea>
                                                        </div>
                                                    </div>




                                                    {{-- <div class="col-md-4 mb-3">
                                                        <div class="mb-3">
                                                            <label for="emailId" class="form-label">Email</label>
                                                            <p><a class="link-info" href="mailto:{{ $cita->email }}">{{ $cita->email }}</a></p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <div class="mb-3">
                                                            <label for="contactNumber" class="form-label">Teléfono / Celular / Whatsapp</label>
                                                            <p>
                                                                <a class="text-info" href="tel:+502{{ $cita->telefono }}">{{ $cita->telefono }}</a>
                                                                @if ($cita->celular != null)
                                                                    <a class="text-info" href="tel:+502{{ $cita->celular }}">/ {{ $cita->celular }}</a>
                                                                    <a class="text-success" href="https://wa.me/502{{ $cita->celular }}" target="_blank">/ <i class="bi bi-whatsapp"></i></a>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4 mb-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Dirección</label>
                                                            <p>{{ $cita->direccion }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mb-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Descripción</label>
                                                            <p>{{ $cita->descripcion }}</p>
                                                        </div>
                                                    </div> --}}

                                                </div>
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
        <!-- Content wrapper end -->
    </div>
    <!-- Content wrapper scroll end -->
@endsection
