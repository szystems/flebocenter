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
        <br><br><br><br><br><br><br>
        {{-- <img align="center" src="{{ $imagen }}" alt="" height="100"> --}}
        <h1><u>Receta</u></h1>
        @php
                $horafecha = new DateTime("now", new DateTimeZone('America/Guatemala'));
                $horafecha = $horafecha->format('d/m/Y')
            @endphp
        {{-- <p align="left"><font size="1">Fecha de impresion: {{ $horafecha }}</font></p> --}}
    </header>
    <section>

                        <font size="1"><strong>Fecha:</strong></font>

                        @php
                            $fecha = date("d/m/Y", strtotime($receta->fecha));
                        @endphp
                        <font size="1">{{ $fecha }}</font>
                        <br>
                        <font size="1"><strong>Paciente:</strong></font>

                        <font size="1">{{ $receta->paciente->nombre }}</font>

                        <font size="1">{!! html_entity_decode($receta->descripcion) !!}</font>


    </section>

    <footer>
        <br><br>
        <table align="center" width="100%">
            <tr>
                <td width="50%" align="center">___________________________</td>
                <td width="50%" align="center">___________________________</td>
            </tr>
            <tr>
                <td width="50%" align="center">Firma del médico</td>
                <td width="50%" align="center">Sello del médico</td>
            </tr>
        </table><br>
        <p align="left">Próxima cita: __________________</p>
    </footer>
</body>

</html>
