<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receta</title>
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
            text-align: left;
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
        <h1><u>Receta</u></h1>
        @php
                $horafecha = new DateTime("now", new DateTimeZone('America/Guatemala'));
                $horafecha = $horafecha->format('d/m/Y')
            @endphp
        {{-- <p align="left"><font size="1">Fecha de impresion: {{ $horafecha }}</font></p> --}}
    </header>
    <section>
        <table class="table" Width=100%>
            <thead>
                <tr>

                    <th align="right">
                        <font size="1">Fecha:</font>
                    </th>
                    <td align="left" colspan="6">
                        @php
                            $fecha = date("d/m/Y", strtotime($receta->fecha));
                        @endphp
                        <font size="1">{{ $fecha }}</font>
                    </td>
                    {{-- <th align="right">
                        <font size="1">Doctor:</font>
                    </th>
                    <td colspan="4" align="left">
                        <font size="1">{{ $receta->doctor->name }} ({{ $receta->doctor->colegiado }})</font>
                    </td> --}}

                </tr>
                {{-- <tr>
                    <th align="right">
                        <font size="1">Doctor:</font>
                    </th>
                    <td colspan="4" align="left">
                        <font size="1">{{ $receta->doctor->name }} ({{ $receta->doctor->colegiado }})</font>
                    </td>
                </tr> --}}
                <tr>
                    <th align="right">
                        <font size="1">Paciente:</font>
                    </th>
                    <td colspan="6" align="left">
                        <font size="1">{{ $receta->paciente->nombre }}</font>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <font size="1">{!! html_entity_decode($receta->descripcion) !!}</font>
                    </td>
                </tr>

            </thead>
            {{-- <tbody>
                <tr>
                    <td align="center">
                        <font size="1">hola</font>
                    </td>
                    <td align="center">
                        <font size="1">hola 2</font>
                    </td>
                </tr>
            </tbody> --}}
        </table>
    </section>

</body>

</html>
