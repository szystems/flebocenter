@extends('layouts.admin')

@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-hospital"></i>
                </div>
                <div class="page-title d-none d-md-block">
                    <h5>Clínicas</h5>
                </div>
            </div>
            <!-- Date range start -->
            <div class="d-flex align-items-end">
                <h6 class="float-end text-light" id="reloj"></h6>
            </div>
        </div>
        <!-- Main header ends -->

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            @include('admin.clinica.search')

            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-sm-12 col-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="card-title">
                                Listado de Clínicas
                                <a href="{{ url('add-clinica') }}" type="button" class="btn btn-success float-end">
                                    <i class="bi bi-plus-square"></i> Agregar
                                </a>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle table-striped flex-column">
                                    <thead>
                                        <tr>
                                            <td align="center"><i class="bi bi-list-task"></i></td>
                                            <td>Clinica</td>
                                            <td>Dirección</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clinicas as $clinica)
                                        <tr>
                                            <td align="center">
                                                <div class="btn-group dropend">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                                        <i class="bi bi-list-task"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('show-clinica/'.$clinica->id) }}"><i class="bi bi-eye-fill text-blue"></i> Información</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('edit-clinica/'.$clinica->id) }}"><i class="bi bi-pencil-fill text-warning"></i> Editar</a>
                                                        </li>
                                                        <li>
                                                            <a type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $clinica->id }}">
                                                                <i class="bi bi-trash-fill text-danger"></i> Eliminar
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    {{-- @if ($user->fotografia != null)
                                                        <img src="{{ asset('assets/imgs/users/'.$user->fotografia) }}" class="img-4x rounded-5 me-3" alt="Doctores" />
                                                    @else
                                                        <img src="{{ asset('assets/imgs/users/doctoricon.png') }}" class="img-4x rounded-5 me-3" alt="Doctores" />
                                                    @endif --}}

                                                    <p class="m-0">
                                                        <a class="text-primary" href="{{ url('show-clinica/'.$clinica->id) }}"><b>{{ $clinica->nombre }}</b></a>
                                                        <small>
                                                            <br>
                                                            <a class="text-info" href="mailto:{{ $clinica->email }}">{{ $clinica->email }}</a>
                                                            <br>
                                                            <a class="text-light" href="tel:+502{{ $clinica->telefono }}">{{ $clinica->telefono }}</a>
                                                            @if ($clinica->celular != null)
                                                            / <a class="text-light" href="tel:+502{{ $clinica->celular }}">{{ $clinica->celular }}</a>

                                                            / <a class="text-success" href="https://wa.me/502{{ $clinica->celular }}" target="_blank"><i class="bi bi-whatsapp"></i></a>
                                                            @endif
                                                        </small>

                                                    </p>

                                                </div>
                                            </td>
                                            <td><small>{{ $clinica->direccion }}</small></td>

                                        </tr>
                                        @include('admin.clinica.deletemodal')
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $clinicas->links() }}
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

