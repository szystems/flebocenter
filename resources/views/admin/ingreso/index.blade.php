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

            @include('admin.ingreso.search')

            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-sm-12 col-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="card-title">
                                Listado de Ingresos
                                <a href="{{ url('add-ingreso') }}" type="button" class="btn btn-success float-end">
                                    <i class="bi bi-plus-square"></i> Agregar
                                </a>
                                <br>
                                <small class="text-secondary"><u>Filtros:</u></small>
                                <small class="text-muted">

                                    Encontrados: <small class="text-info">{{ $ingresos->count() }},</small>
                                    @if ($fechaDesdeVista)
                                        Desde: <small class="text-info">{{ $fechaDesdeVista }},</small>
                                    @endif
                                    @if ($fechaHastaVista)
                                        Hasta: <small class="text-info"">{{ $fechaHastaVista }},</small>
                                    @endif
                                    @if (request('proveedor_id'))
                                        @php
                                            $proveedor = \App\Models\Proveedor::find( request('proveedor_id') );
                                        @endphp
                                        Proveedor:  <small class="text-info">{{ $proveedor->nombre }},</small>
                                    @endif
                                    @if (request('tipo_comprobante'))
                                        Tipo Comprobante:  <small class="text-info">{{ request('tipo_comprobante') }},</small>
                                    @endif
                                    @if (request('numero_comprobante'))
                                        Número Comprobante:  <small class="text-info">{{ request('numero_comprobante') }},</small>
                                    @endif
                                </small>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle table-striped flex-column">
                                    <thead>
                                        <tr>
                                            <td align="center"><i class="bi bi-list-task"></i></td>
                                            <td align="center">Fecha</td>
                                            <td align="center">Proveedor</td>
                                            <td align="center">Comprobante</td>
                                            <td align="center">Pagado/Saldo</td>
                                            <td align="center">Estado Saldo</td>
                                            <td align="right">Total</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $monto_total = 0;
                                            $pagado_total = 0;
                                            $saldo_total = 0;
                                        @endphp
                                        @foreach ($ingresos as $ingreso)
                                        <tr>
                                            <td align="center">
                                                <div class="btn-group dropend">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                                        <i class="bi bi-list-task"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('show-ingreso/'.$ingreso->id) }}"><i class="bi bi-eye-fill text-blue"></i> Información</a>
                                                        </li>
                                                        {{-- <li>
                                                            <a class="dropdown-item" href="{{ url('edit-ingreso/'.$ingreso->id) }}"><i class="bi bi-pencil-fill text-warning"></i> Editar</a>
                                                        </li> --}}
                                                        <li>
                                                            <a type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $ingreso->id }}">
                                                                <i class="bi bi-trash-fill text-danger"></i> Eliminar
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td align="center">
                                                @php
                                                    $fecha = date('d/m/Y', strtotime($ingreso->fecha));
                                                @endphp
                                                <small>{{ $fecha }}</small>
                                            </td>
                                            <td align="center">
                                                <a class="text-yellow" href="{{ url('show-proveedor/'.$ingreso->proveedor_id) }}">{{ $ingreso->proveedor->nombre }}</a>
                                            </td>
                                            <td align="center">
                                                @if ($ingreso->tipo_comprobante)
                                                    {{ $ingreso->tipo_comprobante }}:
                                                @endif
                                                <p>{{ $ingreso->serie_comprobante.' -' }} {{ $ingreso->numero_comprobante }}</p>
                                            </td>
                                            @php
                                                $total = DB::table('ingreso_detalles')
                                                            ->where('ingreso_id', $ingreso->id)
                                                            ->sum('sub_total');
                                                $monto_pagado = \App\Models\PagoIngreso::where('ingreso_id', $ingreso->id)->sum('cantidad');
                                                $saldo = $total - $monto_pagado;
                                            @endphp
                                            <td align="center">
                                                <p>
                                                    <font class="text-success">{{ $config->currency_simbol }}.{{ number_format($monto_pagado,2, '.', ',') }}</font>
                                                    /
                                                    <font class="text-warning">{{ $config->currency_simbol }}.{{ number_format($saldo,2, '.', ',') }}</font>
                                                </p>
                                            </td>
                                            <td align="center">
                                                <p>
                                                    @if($total > $monto_pagado)
                                                        <span class="badge shade-light-yellow">Pendiente</span>

                                                    @elseif ($total <= $monto_pagado)
                                                        <span class="badge shade-light-green">Pagado</span>
                                                    @endif
                                                </p>
                                            </td>
                                            <td align="right">
                                                {{-- <div class="input-group"> --}}
                                                    {{-- <span class="input-group-text">{{ $config->currency_simbol }}.</span> --}}
                                                    @php

                                                    @endphp
                                                    {{-- <span class="input-group-text text-blue"><strong>{{ number_format($total,2, '.', ',') }}</strong></span> --}}
                                                    <p class="text-blue">{{ $config->currency_simbol }}.<strong>{{ number_format($total,2, '.', ',') }}</strong></p>
                                                {{-- </div> --}}
                                            </td>

                                        </tr>
                                        @php
                                            $monto_total += $total;

                                            $pagado_total += $monto_pagado;
                                            $saldo_total += $saldo;
                                        @endphp
                                        @include('admin.ingreso.deletemodal')
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td align="right"><p><strong>Pagado/Saldo:</strong></p></td>
                                            <td align="center"><p><strong class="text-success">{{ $config->currency_simbol }}.{{ number_format($pagado_total,2, '.', ',') }}</strong>/<strong class="text-warning">{{ $config->currency_simbol }}.{{ number_format($saldo_total,2, '.', ',') }}</strong></p></td>
                                            <td align="right"><p><strong>Total:</strong></p></td>
                                            <td align="right"><p><strong class="text-blue">{{ $config->currency_simbol }}.{{ number_format($monto_total,2, '.', ',') }}</strong></p></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                {{-- {{ $ingresos->links() }} --}}
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

