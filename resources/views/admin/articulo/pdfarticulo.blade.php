<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articulo</title>
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
        <h1><u>Articulo</u></h1>
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
                    <th align="right">Articulo:</th>
                    <td colspan="2">
                        <font size="1">
                                <b>{{ $articulo->nombre }}</b>
                        </font>
                    </td>
                    <th align="right">Codigo:</th>
                    <td colspan="3">
                        <font size="1">
                                <b>{{ $articulo->codigo }}</b>
                        </font>
                    </td>
                </tr>
                <tr>
                    <th align="right">Categoría:</th>
                    <td colspan="2">
                        @php
                            $categoria = \App\Models\Categoria::find($articulo->categoria_id);
                        @endphp
                        <font size="1">
                            <strong>{{ $categoria->nombre }}</strong>
                        </font>
                    </td>
                    <th align="right">Proveedor:</th>
                    <td colspan="3">
                        @php
                            $proveedor = \App\Models\Proveedor::find($articulo->proveedor_id);
                        @endphp
                        <font size="1">
                            <strong>{{ $proveedor->nombre }}</strong>
                            <br>
                            {{ $proveedor->email }}
                            <br>
                            {{ $proveedor->telefono }}
                            @if ($proveedor->celular != null)
                            / {{ $proveedor->celular }}
                            @endif
                        </font>
                    </td>
                </tr>
                <tr>
                    <th align="right">Descripción:</th>
                    <td colspan="6">
                        <font size="1">
                            @if ($articulo->descripcion != null)
                                <p>{{ $articulo->descripcion }}</p>
                            @else
                                <p>Sin descripción.</p>
                            @endif
                        </font>
                    </td>
                </tr>
                <tr>
                    <th align="right">Imagen:</th>
                    <td colspan="6" style="overflow: hidden;" align="center">
                        <font size="1">
                            @if ($articulo->imagen != null)
                                <div style="width: auto; height: 200px; overflow: hidden;">
                                    <img src="{{ $patharticulo.$articulo->imagen }}" style="width: auto; height: 100%;" />
                                </div>
                            @else
                                <div style="width: auto; height: 200px; overflow: hidden;">
                                    <img src="{{ $patharticulo.'default.png' }}" style="width: auto; height: 100%;" />
                                </div>
                            @endif
                        </font>
                    </td>
                </tr>


            </thead>
        </table>
        <!-- Other sections... -->
    </section>


</body>

</html>
