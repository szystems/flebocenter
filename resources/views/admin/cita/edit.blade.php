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
                <div class="page-title d-none d-md-block">
                    <h5>Citas</h5>
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


            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="custom-tabs-container">
                                <ul class="nav nav-tabs" id="customTab2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                                            aria-controls="oneA" aria-selected="true">Editar Información de Cita</a>
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
                                                <form action="{{ url('update-cita/'.$cita->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row gx-3">

                                                        <div class="col-md-6 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="paciente_id" class="form-label">
                                                                    Paciente&nbsp;

                                                                </label>

                                                                <select id="miSelect" name="paciente_id" class="form-select">
                                                                    <option selected value="{{ $cita->paciente_id }}">{{ $cita->paciente->nombre }} - DPI: {{ $cita->paciente->dpi }}</option>
                                                                    @foreach($filtroPacientes as $paciente)
                                                                        <option value="{{ $paciente->id }}">{{ $paciente->nombre }} - DPI: {{ $paciente->dpi }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <br>
                                                                <a href="{{ url('add-paciente') }}" type="button" class="text-blue mt-1">
                                                                    <i class="bi bi-plus-square"></i> Agregar Paciente
                                                                </a>
                                                                @if ($errors->has('paciente_id'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('paciente_id') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <div class="row gx-3">

                                                        <div class="col-md-4 mb-3">
                                                            <div class="mb-3">
                                                                <label for="clinica_id" class="form-label">Clínica</label>
                                                                <select name="clinica_id" class="form-select" aria-label="Default select example">
                                                                    <option selected value="{{ $cita->clinica_id }}">{{ $cita->clinica->nombre }}</option>
                                                                    @foreach($filtroClinicas as $clinica)
                                                                        <option value="{{ $clinica->id }}">{{ $clinica->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('clinica_id'))
                                                                    <span class="help-block opacity-7">
                                                                        <strong>
                                                                            <font color="red">{{ $errors->first('clinica_id') }}</font>
                                                                        </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="doctor_id" class="form-label">Doctor</label>
                                                                <select name="doctor_id" class="form-select" aria-label="Default select example">
                                                                    <option selected value="{{ $cita->doctor_id }}">{{ $cita->doctor->name }}</option>
                                                                    @foreach($filtroDoctores as $doctor)
                                                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('doctor_id'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('doctor_id') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row gx-3">

                                                        <div class="col-md-4 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-2">
                                                                <label for="fecha_cita" class="form-label">Fecha</label>
                                                                @php
                                                                    $fecha = date("d-m-Y", strtotime($cita->fecha_cita));
                                                                    $hi = date("H:i", strtotime($cita->hora_inicio));
                                                                    $hf = date("H:i", strtotime($cita->hora_fin));
                                                                @endphp
                                                                <div class="input-group">
                                                                    <input type="text" name="fecha_cita" class="form-control datepicker text-center" id="fecha_cita" value=""/>
                                                                    <span class="input-group-text">
                                                                        <i class="bi bi-calendar4"></i>
                                                                    </span>
                                                                </div>
                                                                @if ($errors->has('fecha_cita'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('fecha_cita') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-2">
                                                                <label for="hora_inicio" class="form-label">Hora Inicio (24 Hrs)</label>
                                                                <input type="time" name="hora_inicio" class="form-control text-center" placeholder="HH-MM" id="time-formatting2" value="{{ $hi }}"/>
                                                                @if ($errors->has('hora_inicio'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('hora_inicio') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-2">
                                                                <label for="hora_fin" class="form-label">Hora Fin (24 Hrs)</label>
                                                                <input type="time" name="hora_fin" class="form-control text-center" placeholder="HH-MM" id="time-formatting2" value="{{ $hf }}"/>
                                                                @if ($errors->has('hora_fin'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('hora_fin') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="estado" class="form-label">Estado</label>
                                                                <select name="estado" class="form-select" aria-label="Default select example">
                                                                    <option value="">Seleccione estado</option>
                                                                    <option value="Pendiente"{{ $cita->estado == 'Pendiente' ? ' selected' : '' }}>Pendiente</option>
                                                                    <option value="Confirmada"{{ $cita->estado == 'Confirmada' ? ' selected' : '' }}>Confirmada</option>
                                                                    <option value="Atendida"{{ $cita->estado == 'Atendida' ? ' selected' : '' }}>Atendida</option>
                                                                </select>
                                                                @if ($errors->has('estado'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('estado') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label class="motivo">Motivo</label>
                                                                <textarea name="motivo" class="form-control" rows="3" placeholder="Motivo de la cita...">{{ $cita->motivo }}</textarea>
                                                                @if ($errors->has('motivo'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('motivo') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <a href="{{ url('clinicas') }}" type="button" class="btn btn-danger">
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
                                    <a href="{{ url('edit-user/'.$user->id) }}" type="button" class="btn btn-outline-secondary">
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
        <!-- Content wrapper end -->
    </div>
    <!-- Content wrapper scroll end -->

    <script>
        $(document).ready(function() {
            $('#miSelect').select2({
                placeholder: "Nombre o DPI...",
                allowClear: true
            });
        });
    </script>

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


        };
        $( '#fecha_cita' ).datepicker( optSimple );
        $( '#fecha_cita').datepicker( 'setDate', '{{ $fecha }}' );
    </script>

@endsection
