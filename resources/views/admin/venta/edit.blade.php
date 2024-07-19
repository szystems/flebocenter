@extends('layouts.admin')
@section('content')

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div class="page-title">
                    <h5>Ventas</h5>
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
                                <ul class="nav nav-tabs" id="customTab2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                                            aria-controls="oneA" aria-selected="true">Editar Información</a>
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
                                                <form action="{{ url('update-venta/'.$venta->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row gx-3">

                                                        <h4>Venta</h4>
                                                        <hr>
                                                        <div class="col-md-12 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="nombre" class="form-label">Editar los datos de venta:</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-2">
                                                                <label for="fecha_cita" class="form-label">Fecha</label>
                                                                <div class="input-group">
                                                                    @php
                                                                        $fecha = date("d-m-Y", strtotime($venta->fecha));
                                                                    @endphp
                                                                    <input type="text" name="fecha" class="form-control datepicker text-center" id="fecha" value="" required/>
                                                                    <span class="input-group-text">
                                                                        <i class="bi bi-calendar4"></i>
                                                                    </span>
                                                                </div>
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
                                                                    $( '#fecha' ).datepicker( optSimple );
                                                                    $( '#fecha').datepicker( 'setDate', '{{ $fecha }}' );
                                                                </script>
                                                                @if ($errors->has('fecha'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('fecha') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-9 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="paciente_id" class="form-label">Paciente</label>
                                                                <select name="paciente_id" class="form-select" aria-label="Default select example" required>
                                                                    <option value="">Seleccione paciente</option>
                                                                    @foreach($pacientes as $paciente)
                                                                        <option value="{{ $paciente->id }}"{{ $venta->paciente_id == $paciente->id ? ' selected' : '' }}>{{ $paciente->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('paciente_id'))
                                                                    <span class="help-block opacity-7">
                                                                        <strong>
                                                                            <font color="red">{{ $errors->first('paciente_id') }}</font>
                                                                        </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="tipo_comprobante" class="form-label">Tipo Comprobante</label>
                                                                <select name="tipo_comprobante" class="form-select" aria-label="Default select example" >
                                                                    <option value=""{{ $venta->tipo_comprobante == '' ? ' selected' : '' }}>Seleccione tipo...</option>
                                                                    <option value="Factura"{{ $venta->tipo_comprobante == 'Factura' ? ' selected' : '' }}>Factura</option>
                                                                    <option value="Recibo"{{ $venta->tipo_comprobante == 'Recibo' ? ' selected' : '' }}>Recibo</option>
                                                                    <option value="Boleta"{{ $venta->tipo_comprobante == 'Boleta' ? ' selected' : '' }}>Boleta</option>
                                                                    <option value="Ticket"{{ $venta->tipo_comprobante == 'Ticket' ? ' selected' : '' }}>Ticket</option>
                                                                </select>
                                                                @if ($errors->has('tipo_comprobante'))
                                                                    <span class="help-block opacity-7">
                                                                        <strong>
                                                                            <font color="red">{{ $errors->first('tipo_comprobante') }}</font>
                                                                        </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="serie_comprobante" class="form-label">Serie Comprobante</label>
                                                                <input name="serie_comprobante" type="text" class="form-control" placeholder="Serie del comprobante..." value="{{ $venta->serie_comprobante }}" />
                                                                @if ($errors->has('serie_comprobante'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('serie_comprobante') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="numero_comprobante" class="form-label">Número Comprobante</label>
                                                                <input name="numero_comprobante" type="text" class="form-control" placeholder="Número del comprobante..." value="{{ $venta->numero_comprobante }}" />
                                                                @if ($errors->has('numero_comprobante'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('numero_comprobante') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <a href="{{ url('ventas') }}" type="button" class="btn btn-danger">
                                                            <i class="bi bi-x-circle"></i> Cancelar
                                                        </a>
                                                        <button type="submit" class="btn btn-success">
                                                            <i class="bi bi-check2-square"></i> Grabar
                                                        </button>
                                                    </div>
                                                </form>
                                                <div class="row gx-3">
                                                    <h4>Detalles de Venta</h4>
                                                    <hr>

                                                    <div class="col-md-4 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                                data-bs-target="#addDetalleModal">
                                                                <i class="bi bi-plus-square"></i> Agregar Detalle
                                                            </button>
                                                        </div>
                                                        @include('admin.venta.adddetallemodal')
                                                    </div>

                                                    <div class="col-md-12 mb-3">

                                                        <div class="table-responsive">
                                                            <table class="table align-middle table-striped flex-column">
                                                                <thead>
                                                                    <tr>
                                                                        <td align="center"><i class="bi bi-list-task"></i></td>
                                                                        <td>Articulo</td>
                                                                        <td align="center">Cantidad</td>
                                                                        <td align="right">Precio Venta</td>
                                                                        <td align="right">Descuento</td>
                                                                        <td align="right">Sub-Total</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($ventaDetalles as $detalle)
                                                                        <tr>
                                                                            <td align="center">
                                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDetalleModal-{{ $detalle->id }}">
                                                                                    <i class="bi bi-trash-fill text-white"></i>
                                                                                </button>
                                                                                @include('admin.venta.deletedetallemodal')
                                                                            </td>
                                                                            <td align="left">

                                                                                <div class="d-flex align-items-center">
                                                                                    @if ($detalle->articulo->imagen != null)
                                                                                        <img src="{{ asset('assets/imgs/articulos/'.$detalle->articulo->imagen) }}" class="img-4x rounded-2 me-3" alt="Artículos" />
                                                                                    @else
                                                                                        <img src="{{ asset('assets/imgs/articulos/default.png') }}" class="img-4x rounded-2 me-3" alt="Artículos" />
                                                                                    @endif

                                                                                    <p class="m-0">
                                                                                        <a class="text-primary" href="{{ url('show-articulo/'.$detalle->articulo->id) }}"><font color="gray"><small>{{ $detalle->articulo->codigo }}</small></font> <b>{{ $detalle->articulo->nombre }}</b></a>
                                                                                        <br>
                                                                                        <small>
                                                                                            Categoría: <a class="text-secondary" href="{{ url('show-categoria/'.$detalle->articulo->categoria->id) }}"><b>{{ $detalle->articulo->categoria->nombre }}</b></a>
                                                                                            <br>
                                                                                            Paciente: <a class="text-yellow" href="{{ url('show-paciente/'.$venta->paciente_id) }}"><b>{{ $venta->paciente->nombre }}</b></a>
                                                                                        </small>
                                                                                    </p>

                                                                                </div>

                                                                            </td>
                                                                            <td align="center">
                                                                                <p >{{ $detalle->cantidad }}</p>
                                                                            </td>
                                                                            <td align="right">
                                                                                {{-- <div class="input-group">
                                                                                    <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                                                                    <span class="input-group-text text-yellow"><strong>{{ number_format($detalle->precio_compra,2, '.', ',') }}</strong></span>
                                                                                </div> --}}
                                                                                <p class="text-success">{{ $config->currency_simbol }}.{{ number_format($detalle->precio_venta,2, '.', ',') }}</p>
                                                                            </td>
                                                                            <td align="right">
                                                                                {{-- <div class="input-group">
                                                                                    <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                                                                    <span class="input-group-text text-yellow"><strong>{{ number_format($detalle->precio_compra,2, '.', ',') }}</strong></span>
                                                                                </div> --}}
                                                                                <p class="text-yellow">{{ $config->currency_simbol }}.{{ number_format($detalle->descuento,2, '.', ',') }}</p>
                                                                            </td>
                                                                            <td align="right">
                                                                                {{-- <div class="input-group">
                                                                                    <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                                                                    <span class="input-group-text text-blue"><strong>{{ number_format($detalle->sub_total,2, '.', ',') }}</strong></span>
                                                                                </div> --}}
                                                                                <p class="text-success"><strong>{{ $config->currency_simbol }}.{{ number_format($detalle->sub_total,2, '.', ',') }}</strong></p>
                                                                            </td>

                                                                        </tr>
                                                                    @endforeach
                                                                    @php

                                                                        $total = DB::table('venta_detalles')
                                                                        ->where('venta_id', $venta->id)
                                                                        ->sum('sub_total');

                                                                        $totalDescuento = DB::table('venta_detalles')
                                                                        ->where('venta_id', $venta->id)
                                                                        ->sum('descuento');
                                                                    @endphp
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td colspan="2" align="right">
                                                                            <h4><strong class="text-secondary">Total Descuento: </strong><strong class="text-warning">{{ $config->currency_simbol }}.{{ number_format($totalDescuento,2, '.', ',') }}</strong></h4>
                                                                        </td>

                                                                        <td colspan="2" align="right">
                                                                            {{-- <div class="input-group">
                                                                                <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                                                                <span class="input-group-text text-danger"><strong><h3>{{ number_format($total,2, '.', ',') }}</h3></strong></span>
                                                                            </div> --}}
                                                                            <h4><strong class="text-secondary">Total: </strong><strong class="text-success">{{ $config->currency_simbol }}.{{ number_format($total,2, '.', ',') }}</strong></h4>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            {{-- {{ $ventas->links() }} --}}
                                                        </div>

                                                    </div>

                                                </div>

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

@endsection
