<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventario</title>
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
        <h1><u>Inventario</u></h1>
        @php
            $horafecha = new DateTime("now", new DateTimeZone('America/Guatemala'));
            $horafecha = $horafecha->format('d/m/Y')
        @endphp
        <p align="left"><font size="1">Fecha de impresion: {{ $horafecha }}</font></p>
    </header>
    <section>
        <h2>Listado de Articulos:</font></h2>
        <p class="m-0 fw-normal">
            <hr>
            <strong><u>Filtros:</u></strong>
            <br>
            <small class="text-muted">

                Encontrados: <font color="blue">{{ $articulos->count() }},</font>
                @if (request('articulo_imprimir'))
                    Articulo / Codigo:  <font color="blue">{{ request('articulo_imprimir') }},</font>
                @endif
                @if (request('categoria_imprimir'))
                    @php
                        $categoria = \App\Models\Categoria::find(request('categoria_imprimir'));
                    @endphp
                    Categoría:  <font color="blue">{{ $categoria->nombre }},</font>
                @endif
                @if (request('proveedor_imprimir'))
                @php
                        $proveedor = \App\Models\Proveedor::find(request('proveedor_imprimir'));
                    @endphp
                    Proveedor:  <font color="blue">{{ $proveedor->nombre }},</font>
                @endif
                @if (request('stock_imprimir'))
                    Stock:  <font color="blue">{{ request('stock_imprimir') }},</font>
                @endif
                @if (request('stockminimo_imprimir'))
                    Stock Minimo:  <font color="blue">{{ request('stockminimo_imprimir') }},</font>
                @endif
            </small>
            <hr>
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th align="left">Articulo</th>
                    <th align="center">Precio</th>
                    <th align="center">Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                    <tr>
                        <td align="left">
                            <font size="1">
                                <font color="gray"><small>{{ $articulo->codigo }}</small></font> <b>{{ $articulo->nombre }}</b>
                                <br>
                                <small>
                                    Categoría: <b>{{ $articulo->categoria->nombre }}</b>
                                    <br>
                                    Proveedor: <b>{{ $articulo->proveedor->nombre }}</b>
                                </small>
                            </font>
                        </td>
                        <td align="center">
                            <font size="1">
                                <font color="blue"><strong>{{ $config->currency_simbol }}.{{ number_format($articulo->precio_compra, 2, '.', ',') }}</strong></font>
                            </font>
                        </td>
                        <td align="center">
                            <font size="1">
                                @if ($articulo->stock <= 0)
                                    <font color="red">{{ $articulo->stock }}</font>
                                @endif
                                @if (($articulo->stock > 0) and ($articulo->stock <= $articulo->stock_minimo))
                                    <font color="orange">{{ $articulo->stock }}</font>
                                @endif
                                @if ($articulo->stock > $articulo->stock_minimo)
                                    <font color="limegreen">{{ $articulo->stock }}</font>
                                @endif
                            </font>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>


</body>

</html>
