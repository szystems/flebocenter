<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            /* text-align: center; */
        }

        .table th {
            background-color: #f0f0f0;
        }

        header {
            text-align: center;
        }

        header h1 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        section {
            margin-bottom: 20px;
        }

        section h2 {
            font-size: 14px;
            margin-top: 10px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }

        footer p {
            margin-bottom: 10px;
        }
        img {
        width: 100%;
        height: auto;
        margin: 0;
        padding: 0;
    }
    </style>
</head>

<body>
    <header>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
        <h1><u>Venta</u></h1>
        @php
            $horafecha = new DateTime("now", new DateTimeZone('America/Guatemala'));
            $horafecha = $horafecha->format('d/m/Y')
        @endphp
        <p align="left"><font size="1">Fecha de impresion: {{ $horafecha }}</font></p>
    </header>
    <section>
        {{-- <h2>Paciente</h2> --}}
        <table class="table">
            <thead>

                <tr>
                    <th align="right">Fecha:</th>
                    <td>
                        @php
                            $fecha = date("d/m/Y", strtotime($venta->fecha));
                        @endphp
                        <font size="1">{{ $fecha }}</font>
                    </td>
                    <th align="right">Paciente:</th>
                    <td>
                        <font size="1">
                            {{ $venta->paciente->nombre }}
                        </font>
                    </td>
                    <th align="right">Comprobante:</th>
                    <td>
                        <font size="1">
                            @if ($venta->tipo_comprobante != null) {{ $venta->tipo_comprobante }}: @endif {{ $venta->serie_comprobante.' -' }} {{ $venta->numero_comprobante }}
                        </font>
                    </td>
                </tr>
                <tr>
                    <th align="right">Pagado / Saldo:</th>
                    <td>
                        <font size="1">
                            @php
                                $saldo = $total - $totalAbonado;
                            @endphp
                            <b><font color="limegreen">Q.{{ number_format($totalAbonado,2, '.', ',') }}</font> / <font color="orange">Q.{{ number_format($saldo,2, '.', ',') }}</font></b>
                        </font>
                    </td>
                    <th align="right">Estado Saldo:</th>
                    <td>
                        <font size="1">
                            <b>
                            @if($total > $totalAbonado)
                                <font color="yellow">Pendiente</font>

                            @elseif ($total <= $totalAbonado)
                                <font color="limegreen">Pagado</font>
                            @endif
                        </b>
                        </font>
                    </td>
                    <th align="right">Total:</th>
                    <td>
                        <font size="1">
                            <b><font color="blue">Q.{{ number_format($total,2, '.', ',') }}</font></b>
                        </font>
                    </td>
                </tr>


            </thead>
        </table>
        <h5><u>Detalles de Venta:</u></h5>
        <table class="table" Width=100%>
            <thead>
                <tr>
                    <th  align="left">
                        <font size="1">Articulo</font>
                    </th>
                    <th align="center">
                        <font size="1">Cantidad</font>
                    </th>
                    <th align="right">
                        <font size="1">Precio Venta</font>
                    </th>
                    <th align="right">
                        <font size="1">Descuento</font>
                    </th>
                    <th align="right">
                        <font size="1">Sub-Total</font>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_compra = 0;
                    $total_utilidad = 0;
                @endphp
                @foreach ($ventaDetalles as $detalle)
                    <tr>
                        <td align="left">
                            <font size="1">
                                <b>{{ $detalle->articulo->nombre }}</b>
                                {{-- <br>
                                <small>
                                    Categoría: <a class="text-secondary" href="{{ url('show-categoria/'.$detalle->articulo->categoria->id) }}"><b>{{ $detalle->articulo->categoria->nombre }}</b></a>
                                    <br>
                                    Paciente: <a class="text-yellow" href="{{ url('show-paciente/'.$detalle->articulo->paciente->id) }}"><b>{{ $detalle->articulo->paciente->nombre }}</b></a>
                                </small> --}}
                            </font>
                        </td>
                        <td align="center">
                            <font size="1">
                                {{ $detalle->cantidad }}
                            </font>
                        </td>
                        <td align="right">
                            <font size="1" color="orange">
                                {{ $config->currency_simbol }}.{{ number_format($detalle->precio_venta,2, '.', ',') }}
                            </font>
                        </td>
                        <td align="right">
                            {{-- <div class="input-group">
                                <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                <span class="input-group-text text-yellow"><strong>{{ number_format($detalle->precio_compra,2, '.', ',') }}</strong></span>
                            </div> --}}
                            <p class="text-yellow">{{ $config->currency_simbol }}.{{ number_format($detalle->descuento,2, '.', ',') }}</p>
                        </td>
                        @php
                            $compra = $detalle->precio_compra * $detalle->cantidad;
                            $utilidad = $detalle->sub_total - $compra;

                            $total_compra += $compra;
                            $total_utilidad += $utilidad;
                        @endphp
                        <td align="right">
                            <font size="1" color="blue">
                                {{ $config->currency_simbol }}.{{ number_format($detalle->sub_total,2, '.', ',') }}
                            </font>
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
                    <td colspan="2" align="right">
                        <h4><b><font color="gray">Total Descuento: </font><font color="orange">{{ $config->currency_simbol }}.{{ number_format($totalDescuento,2, '.', ',') }}</font></b></h4>
                    </td>

                    <td colspan="2" align="right">
                        {{-- <div class="input-group">
                            <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                            <span class="input-group-text text-danger"><strong><h3>{{ number_format($total,2, '.', ',') }}</h3></strong></span>
                        </div> --}}
                        <h4><b><font color="gray">Total: </font><font color="limegreen">{{ $config->currency_simbol }}.{{ number_format($total,2, '.', ',') }}</font></b></h4>
                    </td>
                </tr>

            </tbody>

        </table>
        <h5><u>Pagos:</u></h5>
        <table class="table" Width=100%>
            <thead>
                <tr>
                    <th  align="center">
                        <font size="1">Fecha</font>
                    </th>
                    <th align="right">
                        <font size="1">Cantidad</font>
                    </th>
                    <th align="center">
                        <font size="1">Tipo Pago</font>
                    </th>
                    <th align="center">
                        <font size="1">Imagen</font>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pagos as $pago)
                    <tr>
                        <td align="center">
                            <font size="1">
                                @php
                                    $fecha = date('d/m/Y', strtotime($pago->created_at));
                                @endphp
                                {{ $fecha }}</b>
                            </font>
                        </td>
                        <td align="right">
                            <font size="1" color="orange">
                                <strong>{{ $config->currency_simbol }}.{{ number_format($pago->cantidad,2, '.', ',') }}</strong>
                            </font>
                        </td>
                        <td align="center">
                            <font size="1" color="blue">
                                <b>{{ $pago->tipo_pago }}</b>
                            </font>
                        </td>
                        <td align="center">
                            @if ($pago->imagen)
                                <img src="{{ $path.'pagos/'.$pago->imagen}} " style="max-height: 200px; width: auto;"/>
                            @endif
                        </td>
                    </tr>

                @endforeach
                @php

                    $total = DB::table('venta_detalles')
                    ->where('venta_id', $venta->id)
                    ->sum('sub_total');
                @endphp

            </tbody>

        </table>
        <!-- Other sections... -->
    </section>


</body>

</html>
