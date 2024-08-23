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
    </style>
</head>
<body>
    <header>
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

                Encontrados: <font size="1">{{ $articulos->count() }},</font>
                @if (request('articulo_imprimir'))
                    Articulo / Codigo:  <font size="1">{{ request('articulo_imprimir') }},</font>
                @endif
                @if (request('categoria_imprimir'))
                    @php
                        $categoria = \App\Models\Categoria::find(request('categoria_imprimir'));
                    @endphp
                    Categoría:  <font size="1">{{ $categoria->nombre }},</font>
                @endif
                @if (request('proveedor_imprimir'))
                @php
                        $proveedor = \App\Models\Proveedor::find(request('proveedor_imprimir'));
                    @endphp
                    Proveedor:  <font size="1">{{ $proveedor->nombre }},</font>
                @endif
                @if (request('stock_imprimir'))
                    Stock:  <font size="1">{{ request('stock_imprimir') }},</font>
                @endif
                @if (request('stockminimo_imprimir'))
                    Stock Minimo:  <font size="1">{{ request('stockminimo_imprimir') }},</font>
                @endif
            </small>
            <hr>
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>Articulo</th>
                    <th>Categoria</th>
                    <th>Proveedor</th>
                    <th>Precio Venta</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                    <tr>
                        <td align="left">{{ $articulo->nombre }}</td>
                        <td align="left">{{ $articulo->categoria->nombre }}</td>
                        <td align="left">{{ $articulo->proveedor->nombre }}</td>
                        <td align="right">{{ $articulo->precio_venta }}</td>
                        <td align="right">{{ $articulo->stock }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <footer>
        <p>Fin del informe</p>
    </footer>
</body>
</html>
