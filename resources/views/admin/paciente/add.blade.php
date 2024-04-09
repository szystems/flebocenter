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
                                    <img src="{{ asset('assets/imgs/pacientes/doctoricon.png') }}" class="img-7xx rounded-circle" />
                            </div>
                            <div class="col">
                                <h6>Paciente</h6>
                                {{-- <h4 class="m-0">{{ $paciente->name }}</h4> --}}
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
                                            <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                                                aria-controls="oneA" aria-selected="true">Crear Paciente</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content h-350">
                                        <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                                            <!-- Row start -->
                                            <div class="row gx-3">

                                                <div class="col-sm-12 col-12">
                                                    @if (count($errors)>0)
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{$error}}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                    @endif
                                                    <form action="{{ url('insert-paciente') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row gx-3">

                                                            <div class="col-md-3 mb-3">
                                                                <!-- Form Field Start -->
                                                                <div class="mb-3">
                                                                    <label for="nombre" class="form-label">Nombre</label>
                                                                    <input name="nombre" type="text" class="form-control" placeholder="Nombre Completo..." value="{{ old('nombre') }}" />
                                                                    @if ($errors->has('nombre'))
                                                                        <span class="help-block opacity-7">
                                                                                <strong>
                                                                                    <font color="red">{{ $errors->first('nombre') }}</font>
                                                                                </strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 mb-3">
                                                                <!-- Form Field Start -->
                                                                <div class="mb-3">
                                                                    <label for="ocupacion" class="form-label">Ocupación</label>
                                                                    <input name="ocupacion" type="text" class="form-control" placeholder="Ocupacion del paciente..." value="{{ old('ocupacion') }}" />
                                                                    @if ($errors->has('ocupacion'))
                                                                        <span class="help-block opacity-7">
                                                                                <strong>
                                                                                    <font color="red">{{ $errors->first('ocupacion') }}</font>
                                                                                </strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 mb-3">
                                                                <!-- Form Field Start -->
                                                                <div class="mb-3">
                                                                    <label for="birthDay" class="form-label">Fecha de Nacimiento</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="fecha_nacimiento" class="form-control datepicker" id="fnacimiento" value="{{ old('fnacimiento') }}"/>
                                                                        <span class="input-group-text">
                                                                            <i class="bi bi-calendar4"></i>
                                                                        </span>
                                                                        @php
                                                                            // dd($fnacimiento)
                                                                        @endphp
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 mb-3">
                                                                <!-- Form Field Start -->
                                                                <div class="mb-3">
                                                                    <label for="sexo" class="form-label">Sexo</label>
                                                                    <select name="sexo" class="form-select" aria-label="Default select example">
                                                                        <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>M</option>
                                                                        <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>F</option>
                                                                    </select>
                                                                    @if ($errors->has('sexo'))
                                                                        <span class="help-block opacity-7">
                                                                                <strong>
                                                                                    <font color="red">{{ $errors->first('sexo') }}</font>
                                                                                </strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <!-- Form Field Start -->
                                                                <div class="mb-3">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input name="email" type="text" class="form-control" placeholder="Correo electronico..." value="{{ old('email') }}" />
                                                                    @if ($errors->has('email'))
                                                                        <span class="help-block opacity-7">
                                                                                <strong>
                                                                                    <font color="red">{{ $errors->first('email') }}</font>
                                                                                </strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <!-- Form Field Start -->
                                                                <div class="mb-3">
                                                                    <label for="telefono" class="form-label">Teléfono</label>
                                                                    <input name="telefono" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" placeholder="Telefono..." value="{{ old('telefono') }}" />
                                                                    @if ($errors->has('telefono'))
                                                                        <span class="help-block opacity-7">
                                                                                <strong>
                                                                                    <font color="red">{{ $errors->first('telefono') }}</font>
                                                                                </strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <!-- Form Field Start -->
                                                                <div class="mb-3">
                                                                    <label for="celular" class="form-label">Celular</label>
                                                                    <input name="celular" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" placeholder="Celular..." value="{{ old('celular') }}"/>
                                                                    @if ($errors->has('telefono'))
                                                                        <span class="help-block opacity-7">
                                                                                <strong>
                                                                                    <font color="red">{{ $errors->first('celular') }}</font>
                                                                                </strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mb-3">
                                                                <!-- Form Field Start -->
                                                                <div class="mb-3">
                                                                    <label class="form-label">Dirección</label>
                                                                    <textarea name="direccion" class="form-control" rows="3" placeholder="Dirección del Paciente...">{{ old('direccion') }}</textarea>
                                                                    @if ($errors->has('direccion'))
                                                                        <span class="help-block opacity-7">
                                                                                <strong>
                                                                                    <font color="red">{{ $errors->first('direccion') }}</font>
                                                                                </strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <!-- Form Field Start -->
                                                                <div class="mb-3">
                                                                    <label for="dpi" class="form-label">DPI</label>
                                                                    <input name="dpi" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" placeholder="# DPI..." value="{{ old('dpi') }}"/>
                                                                    @if ($errors->has('dpi'))
                                                                        <span class="help-block opacity-7">
                                                                                <strong>
                                                                                    <font color="red">{{ $errors->first('dpi') }}</font>
                                                                                </strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <!-- Form Field Start -->
                                                                <div class="mb-3">
                                                                    <label for="nit" class="form-label">NIT</label>
                                                                    <input name="nit" type="text" class="form-control" placeholder="# de NIT..." value="{{ old('nit') }}" />
                                                                    @if ($errors->has('nit'))
                                                                        <span class="help-block opacity-7">
                                                                                <strong>
                                                                                    <font color="red">{{ $errors->first('nit') }}</font>
                                                                                </strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <!-- Form Field Start -->
                                                                <div class="mb-3">
                                                                    <label class="form-label">Cambiar Imagen</label>
                                                                    <input type="file" name="fotografia" class="form-control border" value="{{ old('fotografia') }}">
                                                                    @if ($errors->has('fotografia'))
                                                                        <span class="help-block opacity-7">
                                                                                <strong>
                                                                                    <font color="red">{{ $errors->first('fotografia') }}</font>
                                                                                </strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="d-flex gap-2 justify-content-center">
                                                            <a href="{{ url('pacientes') }}" type="button" class="btn btn-danger">
                                                                <i class="bi bi-x-circle"></i> Cancelar
                                                            </a>
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="bi bi-check2-square"></i> Grabar
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Row end -->
                                        </div>

                                    </div>
                                    {{-- <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ url('edit-paciente/'.$paciente->id) }}" type="button" class="btn btn-outline-secondary">
                                            Cancelar
                                        </a>
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

    <script>
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

        var optSimple = {
            language: "es",
            format: "dd-mm-yyyy",
            autoclose: true,
            todayHighlight: true,
            todayBtn: "linked",
            orientation: "bottom auto",
            startDate: "01-01-1900",
            endDate: today,

        };
        $( '#fnacimiento' ).datepicker( optSimple );
    </script>

@endsection
