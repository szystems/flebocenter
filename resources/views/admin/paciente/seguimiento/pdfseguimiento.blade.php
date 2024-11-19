<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seguimiento</title>
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
        {{-- <h1><u>Seguimiento</u></h1> --}}
        @php
                $horafecha = new DateTime("now", new DateTimeZone('America/Guatemala'));
                $horafecha = $horafecha->format('d/m/Y')
            @endphp
        {{-- <p align="left"><font size="{{ $pdfletra }}">Fecha de impresion: {{ $horafecha }}</font></p> --}}
    </header>
    <section>
        <h2 align="center"><u>Seguimiento</u></h2>

        <font size="{{ $pdfletra }}"><strong>Fecha:</strong></font>

        @php
            $fecha = date("d/m/Y", strtotime($seguimiento->fecha));
        @endphp
        <font size="{{ $pdfletra }}">{{ $fecha }}</font>
        <br>
        <font size="{{ $pdfletra }}"><strong>Paciente:</strong></font>

        <font size="{{ $pdfletra }}">{{ $seguimiento->paciente->nombre }}</font>

        <br>
        <font size="{{ $pdfletra }}"><strong>Doctor:</strong></font>

        <font size="{{ $pdfletra }}">{{ $seguimiento->doctor->name }} ({{ $seguimiento->doctor->colegiado }})</font>

        <br><br>
        <strong>Descripcion</strong>

        <font size="{{ $pdfletra }}">{!! html_entity_decode($seguimiento->descripcion) !!}</font>

    </section>

    {{-- <footer>

        <table align="center" width="100%">
            <tr>
                <td width="50%" align="center">___________________________</td>
                <td width="50%" align="center">___________________________</td>
            </tr>
            <tr>
                <td width="50%" align="center">Firma del médico</td>
                <td width="50%" align="center">Sello del médico</td>
            </tr>
        </table>
        <p align="left">Próxima cita: __________________</p>
    </footer> --}}
</body>

</html>
