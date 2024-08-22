<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articulos</title>
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
            text-align: center;
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
        <h1><u>Articulos</u></h1>
        @php
            $horafecha = new DateTime("now", new DateTimeZone('America/Guatemala'));
            $horafecha = $horafecha->format('d/m/Y')
        @endphp
        <p align="left"><font size="1">Fecha de impresion: {{ $horafecha }}</font></p>
    </header>
    <section>
        <h2>Listado de articulos:</h2>
        <p class="m-0 fw-normal">
            <hr>
            <strong><u>Filtros:</u></strong>
            <br>
            <small>
                @if (request('articulo_imprimir'))
                    <strong>Nombre: </strong><font color="Blue">{{ request('articulo_imprimir') }}</font>
                @endif
                @if (request('categoria_imprimir'))
                    @php
                        $categoria = \App\Models\Categoria::find(request('categoria_imprimir'));
                    @endphp
                    <strong>Clinica: </strong><font color="Blue">{{ $categoria->nombre }}</font>
                @endif
                @if (request('proveedor_imprimir'))
                    @php
                        $proveedor = \App\Models\Proveedor::find(request('proveedor_imprimir'));
                    @endphp
                    <strong>Proveedor: </strong><font color="Blue">{{ $proveedor->nombre }}</font>
                @endif
            </small>
            <hr>
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>Articulo</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                    <tr>
                        <td>
                            <font size="1">
                            <p class="m-0">
                                <font color="gray"><small>{{ $articulo->codigo }}</small></font> <b>{{ $articulo->nombre }}</b>
                                <br>
                                <small>
                                    Categoría: <b>{{ $articulo->categoria->nombre }}</b>
                                    <br>
                                    Proveedor: <b>{{ $articulo->proveedor->nombre }}</b>
                                </small>
                            </p>
                            </font>
                        </td>
                        <td>
                            @if ($articulo->imagen != null)
                                <img src="{{ $patharticulo.$articulo->imagen }}" style="max-height: 50px; width: auto;" />
                            @else
                                <img src="{{ $patharticulo.'default.png' }}" style="max-height: 50px; width: auto;" />
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>


</body>

</html>
