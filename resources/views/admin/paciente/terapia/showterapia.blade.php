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



                                <div class="row gx-3">

                                    <div class="col-md-12 mb-3">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <h5 class="card-title"><u>Informacíon de Paciente</u></h5>
                                            {{-- <a href="{{ url('edit-paciente/'.$paciente->id) }}" class="btn btn-warning float-end m-1" aria-current="page"><i class="bi bi-pencil"></i> Editar</a>
                                            <button type="button" class="btn btn-danger float-end m-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $paciente->id }}">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                            @include('admin.paciente.deletemodal') --}}
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-3 mb-3">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="fullName" class="form-label">Nombre</label>
                                            <p>{{ $paciente->nombre }}</p>
                                        </div>
                                    </div> --}}

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

                                    {{-- <div class="col-md-3 mb-3">
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
                                    </div> --}}



                                    <h5 class="modal-title">
                                        <u>Terapia de Drenaje Linfático</u>
                                    </h5>

                                    <hr>

                                    <div class="col-md-12 mb-3">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">

                                            <button type="button" class="btn btn-warning float-end m-1" data-bs-toggle="modal"
                                                data-bs-target="#editarTerapiaModal{{ $terapia->id }}">
                                                <i class="bi bi-pencil"></i> Editar
                                            </button>

                                            @if (Auth::user()->principal == 1)
                                                <button type="button" class="btn btn-danger float-end m-1" data-bs-toggle="modal" data-bs-target="#deleteTerapiaModal-{{ $terapia->id }}">
                                                    <i class="bi bi-trash-fill text-white"></i> Eliminar
                                                </button>
                                            @endif

                                            @include('admin.paciente.terapia.editterapiamodal')
                                            @include('admin.paciente.terapia.deleteterapiamodal')
                                        </div>
                                    </div>

                                    @php
                                        $fechainicio = date("d-m-Y", strtotime($terapia->created_at));
                                        $fechaultima = date("d-m-Y", strtotime($terapia->updated_at));
                                    @endphp

                                    <div class="col-md-4 mb-3">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Inicio</label>
                                            <p>{{ $fechainicio }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Ultima Terapia</label>
                                            <p>{{ $fechaultima }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Talla de Media</label>
                                            <p>{{ $terapia->talla_media }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label class="form-label">Diagnostico</label>
                                            <textarea class="form-control" rows="5" placeholder="Diagnostico..." readonly>{{ $terapia->diagnostico }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label class="form-label">Observaciones</label>
                                            <textarea class="form-control" rows="5" placeholder="Observaciones..." readonly>{{ $terapia->observaciones }}</textarea>
                                        </div>
                                    </div>

                                    <h5 class="modal-title">
                                        <u>Sesiones Miembro Inferior Izquierdo</u>
                                    </h5>

                                    <hr>

                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#addIzqModal">
                                        <i class="bi bi-plus-square"></i> Agregar Sesion
                                    </button>

                                    @include('admin.paciente.terapia.izquierda.addmodal')

                                    <div class="table-responsive">
                                        <table class="table align-middle table-striped flex-column">
                                            <thead>
                                                <tr>
                                                    <td align="center"><i class="bi bi-list-task"></i></td>
                                                    <td align="center">fecha</td>
                                                    <td colspan="4" align="center">Antes</td>
                                                    <td colspan="4" align="center">Despues</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sesionesIzquierda as $sesion)
                                                <tr>
                                                    <td align="center">
                                                        <button type="button" class="btn btn-warning  m-1" data-bs-toggle="modal"
                                                            data-bs-target="#editarIzqModal{{ $sesion->id }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>

                                                        @if (Auth::user()->principal == 1)
                                                            <button type="button" class="btn btn-danger  m-1" data-bs-toggle="modal" data-bs-target="#deleteIzqModal-{{ $sesion->id }}">
                                                                <i class="bi bi-trash-fill text-white"></i>
                                                            </button>
                                                        @endif

                                                        @include('admin.paciente.terapia.izquierda.editmodal')
                                                        @include('admin.paciente.terapia.izquierda.deletemodal')
                                                    </td>
                                                    <td align="center">
                                                        @php
                                                            $fechacreated = date('d/m/Y', strtotime($sesion->created_at));
                                                            $fechaupdated = date('d/m/Y', strtotime($sesion->updated_at));
                                                        @endphp
                                                        <p><font class="text-info">{{ $fechacreated }}</font> - <font class="text-success">{{ $fechacreated }}</font> </p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-warning">{{ $sesion->antes1 }} </p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-warning">{{ $sesion->antes2 }}</p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-warning">{{ $sesion->antes3 }}</p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-warning">{{ $sesion->antes4 }}</p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-success">{{ $sesion->despues1 }} </p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-success">{{ $sesion->despues2 }}</p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-success">{{ $sesion->despues3 }}</p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-success">{{ $sesion->despues4 }}</p>
                                                    </td>


                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if ($sesionesIzquierda->count() == 0)
                                            <div class="alert alert-warning text-white" role="alert">
                                                <ul align="center">
                                                    <p>No se han ingresado sesiones.</p>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>

                                    <h5 class="modal-title">
                                        <u>Sesiones Miembro Inferior Derecho</u>
                                    </h5>

                                    <hr>

                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#addDerModal">
                                        <i class="bi bi-plus-square"></i> Agregar Sesion
                                    </button>

                                    @include('admin.paciente.terapia.derecha.addmodal')

                                    <div class="table-responsive">
                                        <table class="table align-middle table-striped flex-column">
                                            <thead>
                                                <tr>
                                                    <td align="center"><i class="bi bi-list-task"></i></td>
                                                    <td align="center">fecha</td>
                                                    <td colspan="4" align="center">Antes</td>
                                                    <td colspan="4" align="center">Despues</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sesionesDerecha as $sesion)
                                                <tr>
                                                    <td align="center">
                                                        <button type="button" class="btn btn-warning  m-1" data-bs-toggle="modal"
                                                            data-bs-target="#editarDerModal{{ $sesion->id }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>

                                                        @if (Auth::user()->principal == 1)
                                                            <button type="button" class="btn btn-danger  m-1" data-bs-toggle="modal" data-bs-target="#deleteDerModal-{{ $sesion->id }}">
                                                                <i class="bi bi-trash-fill text-white"></i>
                                                            </button>
                                                        @endif

                                                        @include('admin.paciente.terapia.derecha.editmodal')
                                                        @include('admin.paciente.terapia.derecha.deletemodal')
                                                    </td>
                                                    <td align="center">
                                                        @php
                                                            $fechacreated = date('d/m/Y', strtotime($sesion->created_at));
                                                            $fechaupdated = date('d/m/Y', strtotime($sesion->updated_at));
                                                        @endphp
                                                        <p><font class="text-info">{{ $fechacreated }}</font> - <font class="text-success">{{ $fechacreated }}</font> </p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-warning">{{ $sesion->antes1 }} </p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-warning">{{ $sesion->antes2 }}</p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-warning">{{ $sesion->antes3 }}</p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-warning">{{ $sesion->antes4 }}</p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-success">{{ $sesion->despues1 }} </p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-success">{{ $sesion->despues2 }}</p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-success">{{ $sesion->despues3 }}</p>
                                                    </td>
                                                    <td align="center">
                                                        <p class="text-success">{{ $sesion->despues4 }}</p>
                                                    </td>


                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if ($sesionesDerecha->count() == 0)
                                            <div class="alert alert-warning text-white" role="alert">
                                                <ul align="center">
                                                    <p>No se han ingresado sesiones.</p>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>

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
