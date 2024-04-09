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
            <div class="d-flex align-items-end d-none d-sm-block">
                <h6 class="float-end text-light" id="reloj"></h6>
            </div>
        </div>
        <!-- Main header ends -->

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            @include('admin.paciente.search')

            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-sm-12 col-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="card-title">
                                Listado de Pacientes
                                <a href="{{ url('add-paciente') }}" type="button" class="btn btn-success float-end">
                                    <i class="bi bi-plus-square"></i> Agregar
                                </a>
                            </div>

                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table id="highlightRowColumn" class="table custom-table">
                                    <thead>
                                        <tr>
                                            <td align="center"><i class="bi bi-list-task"></i></td>
                                            <td>Paciente</td>
                                            <td>Fecha de Nacimiento</td>
                                            <td>DPI</td>
                                            <td>NIT</td>
                                            <td>Dirección</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pacientes as $paciente)
                                        <tr>
                                            <td>
                                                <div class="btn-group dropend">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                                        <i class="bi bi-list-task"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('show-paciente/'.$paciente->id) }}"><i class="bi bi-eye-fill text-blue"></i> Información</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('edit-paciente/'.$paciente->id) }}"><i class="bi bi-pencil-fill text-warning"></i> Editar</a>
                                                        </li>
                                                        <li>
                                                            <a type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $paciente->id }}">
                                                                <i class="bi bi-trash-fill text-danger"></i> Eliminar
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($paciente->fotografia != null)
                                                        <img src="{{ asset('assets/imgs/pacientes/'.$paciente->fotografia) }}" class="img-4x rounded-5 me-3" alt="Pacientes" />
                                                    @else
                                                        <img src="{{ asset('assets/imgs/pacientes/doctoricon.png') }}" class="img-4x rounded-5 me-3" alt="Pacientes" />
                                                    @endif

                                                    <p class="m-0">
                                                        <a class="text-primary" href="{{ url('show-paciente/'.$paciente->id) }}"><b>{{ $paciente->nombre }}</b></a>
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
                                                        @if ($edad > 0)
                                                            <small>
                                                                ({{ $edad }} años)
                                                            </small>
                                                        @endif
                                                        <br>
                                                        <small>
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
                                            <td align="center">
                                                <small>
                                                    {{ $fnacimiento }}
                                                </small>
                                            </td>
                                            <td align="center">
                                                <small>
                                                    {{ $paciente->dpi }}
                                                </small>
                                            </td>
                                            <td align="center">
                                                <small>
                                                    {{ $paciente->nit }}
                                                </small>
                                            </td>
                                            <td><small>{{ $paciente->direccion }}</small></td>
                                        </tr>
                                        @include('admin.paciente.deletemodal')
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $pacientes->links() }}
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

