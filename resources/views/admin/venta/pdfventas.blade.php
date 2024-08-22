<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ventas</title>
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
        <h1><u>Ventas</u></h1>
        @php
            $horafecha = new DateTime("now", new DateTimeZone('America/Guatemala'));
            $horafecha = $horafecha->format('d/m/Y')
        @endphp
        <p align="left"><font size="1">Fecha de impresion: {{ $horafecha }}</font></p>
    </header>
    <section>
        <h2>Listado de ventas:</font></h2>
        <p class="m-0 fw-normal">
            <hr>
            <strong><u>Filtros:</u></strong>
            <br>
            <small class="text-muted">

                Encontrados: <font color="blue">{{ $ventas->count() }},</font>
                @if ($request->input('desde_imprimir'))
                    Desde: <font color="blue">{{ $request->input('desde_imprimir') }},</font>
                @endif
                @if ($request->input('hasta_imprimir'))
                    Hasta: <font color="blue">{{ $request->input('hasta_imprimir') }},</font>
                @endif
                @if (request('paciente_imprimir'))
                    @php
                        $paciente = \App\Models\Paciente::find( $request->input('paciente_imprimir') );
                    @endphp
                    Paciente:  <font color="blue">{{ $paciente->nombre }},</font>
                @endif
                @if (request('tipocomprobante_imprimir'))
                    Tipo Comprobante:  <font color="blue">{{ request('tipocomprobante_imprimir') }},</font>
                @endif
                @if (request('tipo_comprobante'))
                    Número Comprobante:  <font color="blue">{{ request('tipo_comprobante') }},</font>
                @endif
                @if (request('saldo_imprimir'))
                    Saldo:  <font color="blue">{{ request('saldo_imprimir') }},</font>
                @endif
            </small>
            <hr>
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Paciente</th>
                    <th>Comprobante</th>
                    <th>Pagado/Saldo</th>
                    <th>Estado Saldo</th>
                    <th>Compra / Utilidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $monto_total = 0;
                    $pagado_total = 0;
                    $saldo_total = 0;
                    $total_compras = 0
                @endphp
                @foreach ($ventas as $venta)
                    <tr>
                        <td align="center"><font size="1">
                            @php
                                $fecha = date('d/m/Y', strtotime($venta->fecha));
                            @endphp
                            {{ $fecha }}
                        </td>
                        <td align="center">
                            <font size="1">
                                {{ $venta->paciente->nombre }}
                            </font>
                        </td>
                        <td align="center">
                            <font size="1">
                                <@if ($venta->tipo_comprobante)
                                    {{ $venta->tipo_comprobante }}:
                                @endif
                                {{ $venta->serie_comprobante.' -' }} {{ $venta->numero_comprobante }}
                            </font>
                        </td>
                        @php
                            $total = DB::table('venta_detalles')
                                        ->where('venta_id', $venta->id)
                                        ->sum('sub_total');
                            $compras = DB::table('venta_detalles')
                                        ->where('venta_id', $venta->id)
                                        ->sum(DB::raw('precio_compra * cantidad'));
                            $monto_pagado = \App\Models\PagoVenta::where('venta_id', $venta->id)->sum('cantidad');
                            $saldo = $total - $monto_pagado;
                        @endphp
                        <td align="center">
                            <font size="1">
                                <p>
                                    <font color="green">{{ $config->currency_simbol }}.{{ number_format($monto_pagado,2, '.', ',') }}</font>
                                    /
                                    <font color="orange">{{ $config->currency_simbol }}.{{ number_format($saldo,2, '.', ',') }}</font>
                                </p>
                            </font>
                        </td>
                        <td  align="center">
                            <font size="1">
                                @if($total > $monto_pagado)
                                    <font color="orange">Pendiente</font>

                                @elseif ($total <= $monto_pagado)
                                    <font color="limegreen">Pagado</font>
                                @endif
                            </font>
                        </td>
                        <td align="center">
                            <font color="orange"><strong>{{ $config->currency_simbol }}.{{ number_format($compras,2, '.', ',') }}</strong></font> / <font color="limegreen">{{ $config->currency_simbol }}.<strong>{{ number_format($total-$compras,2, '.', ',') }}</strong></font>
                        </td>
                        <td align="right">
                            <font sizef="1">
                                <font color="blue">{{ $config->currency_simbol }}.<strong>{{ number_format($total,2, '.', ',') }}</strong></font>
                            </font>
                        </td>
                    </tr>
                    @php
                        $monto_total += $total;
                        $total_compras += $compras;
                        $pagado_total += $monto_pagado;
                        $saldo_total += $saldo;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td align="right"><p><strong>Compra/Utilidad:</strong></p></td>
                    @php
                        $utilidad =  $monto_total - $total_compras;
                    @endphp
                    <td align="center"><strong><font color="orange">{{ $config->currency_simbol }}.{{ number_format($total_compras,2, '.', ',') }}</font> / <font color="limegreen">{{ $config->currency_simbol }}.{{ number_format($utilidad,2, '.', ',') }}</font></strong></td>
                    <td align="right"><p><strong>Pagado/Saldo:</strong></p></td>
                    <td align="center"><strong><font color="limegreen">{{ $config->currency_simbol }}.{{ number_format($pagado_total,2, '.', ',') }}</font> / <font color="orange">{{ $config->currency_simbol }}.{{ number_format($saldo_total,2, '.', ',') }}</font></strong></td>
                    <td align="right"><p><strong>Total:</strong></p></td>
                    <td align="right"><strong><font color="blue">{{ $config->currency_simbol }}.{{ number_format($monto_total,2, '.', ',') }}</font></strong></td>
                </tr>
            </tfoot>
        </table>
    </section>


</body>

</html>
