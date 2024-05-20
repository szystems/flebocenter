@extends('layouts.admin')
@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-cart-plus"></i>
                </div>
                <div class="page-title">
                    <h5>Ingresos</h5>
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
                                        <a href="{{ url('edit-ingreso/'.$ingreso->id) }}" class="btn btn-warning" aria-current="page"><i class="bi bi-pencil"></i> Editar</a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $ingreso->id }}">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                        @include('admin.ingreso.deletemodal')
                                    </div>
                                </div>
                                <ul class="nav nav-tabs" id="customTab2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                                            aria-controls="oneA" aria-selected="true">Información</a>
                                    </li>
                                </ul>
                                <div class="tab-content h-350">
                                    <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                                        <!-- Row start -->
                                        <div class="row gx-3">
                                            <div class="col-sm-12 col-12">
                                                <div class="row gx-3">

                                                            <h4>Ingreso</h4>
                                                    <hr>
                                                    <div class="col-md-3 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="fecha" class="form-label">Fecha</label>
                                                            @php
                                                                $fecha = date("d/m/Y", strtotime($ingreso->fecha));
                                                            @endphp
                                                            <p>{{ $fecha }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="codigo" class="form-label">Proveedor</label>
                                                            <p><a href="{{ url('show-proveedor/'.$ingreso->proveedor_id) }}"></a>{{ $ingreso->proveedor->nombre }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="categoria" class="form-label">Comprobante</label>
                                                            <p>@if ($ingreso->tipo_comprobante != null) {{ $ingreso->tipo_comprobante }}: @endif {{ $ingreso->serie_comprobante.' -' }} {{ $ingreso->numero_comprobante }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <!-- Form Field Start -->
                                                        <div class="mb-3">
                                                            <label for="proveedor" class="form-label">Tipo Pago</label>
                                                            <p>{{ $ingreso->tipo_pago }}</p>
                                                        </div>
                                                    </div>

                                                            <h4>Detalle</h4>
                                                    <hr>

                                                    <div class="col-md-12 mb-3">

                                                        <div class="table-responsive">
                                                            <table class="table align-middle table-striped flex-column">
                                                                <thead>
                                                                    <tr>
                                                                        <td>Articulo</td>
                                                                        <td align="right">Precio Compra</td>
                                                                        <td align="center">Cantidad</td>
                                                                        <td align="right">Sub-Total</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($ingresoDetalles as $detalle)
                                                                        <tr>

                                                                            <td align="left">

                                                                                <div class="d-flex align-items-center">
                                                                                    @if ($detalle->articulo->imagen != null)
                                                                                        <img src="{{ asset('assets/imgs/articulos/'.$detalle->articulo->imagen) }}" class="img-4x rounded-2 me-3" alt="Artículos" />
                                                                                    @else
                                                                                        <img src="{{ asset('assets/imgs/articulos/default.png') }}" class="img-4x rounded-2 me-3" alt="Artículos" />
                                                                                    @endif

                                                                                    <p class="m-0">
                                                                                        <a class="text-primary" href="{{ url('show-articulo/'.$detalle->articulo->id) }}"><b>{{ $detalle->articulo->nombre }}</b></a>
                                                                                        <br>
                                                                                        <small>
                                                                                            <a class="text-secondary" href="{{ url('show-categoria/'.$detalle->articulo->categoria->id) }}"><b>{{ $detalle->articulo->categoria->nombre }}</b></a>
                                                                                            <br>
                                                                                            <a class="text-yellow" href="{{ url('show-articulo/'.$detalle->articulo->proveedor->id) }}"><b>{{ $detalle->articulo->proveedor->nombre }}</b></a>
                                                                                        </small>
                                                                                    </p>

                                                                                </div>

                                                                            </td>
                                                                            <td align="right">
                                                                                {{-- <div class="input-group">
                                                                                    <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                                                                    <span class="input-group-text text-yellow"><strong>{{ number_format($detalle->precio_compra,2, '.', ',') }}</strong></span>
                                                                                </div> --}}
                                                                                <p class="text-yellow">{{ $config->currency_simbol }}.{{ number_format($detalle->precio_compra,2, '.', ',') }}</p>
                                                                            </td>
                                                                            <td align="center">
                                                                                <p >{{ $detalle->cantidad }}</p>
                                                                            </td>
                                                                            <td align="right">
                                                                                {{-- <div class="input-group">
                                                                                    <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                                                                    <span class="input-group-text text-blue"><strong>{{ number_format($detalle->sub_total,2, '.', ',') }}</strong></span>
                                                                                </div> --}}
                                                                                <p class="text-blue">{{ $config->currency_simbol }}.{{ number_format($detalle->sub_total,2, '.', ',') }}</p>
                                                                            </td>

                                                                        </tr>
                                                                    @endforeach
                                                                    @php

                                                                        $total = DB::table('ingreso_detalles')
                                                                        ->where('ingreso_id', $ingreso->id)
                                                                        ->sum('sub_total');
                                                                    @endphp
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td colspan="4" align="right">
                                                                            {{-- <div class="input-group">
                                                                                <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                                                                <span class="input-group-text text-danger"><strong><h3>{{ number_format($total,2, '.', ',') }}</h3></strong></span>
                                                                            </div> --}}
                                                                            <p><strong class="text-secondary">Total: </strong><strong class="text-danger">{{ $config->currency_simbol }}.{{ number_format($total,2, '.', ',') }}</strong></p>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            {{-- {{ $ingresos->links() }} --}}
                                                        </div>

                                                    </div>



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
