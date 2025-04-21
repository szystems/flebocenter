<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evaluación Bariátrica</title>
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

        .datos-antropometricos {
            width: 100%;
            margin-bottom: 15px;
        }

        .datos-antropometricos td, .datos-antropometricos th {
            padding: 5px;
            border: 1px solid #ddd;
        }

        .datos-antropometricos th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        @if($imagen)
            <img align="center" src="{{ $imagen }}" alt="Logo" height="100">
        @endif
        <h1>Evaluación Bariátrica</h1>
        @php
            $fechaEmision = new DateTime("now", new DateTimeZone('America/Guatemala'));
            $fechaEmision = $fechaEmision->format('d/m/Y');
        @endphp
        <p align="right">Fecha de emisión: {{ $fechaEmision }}</p>
    </header>

    <section>
        <h2>Datos del Paciente</h2>
        <p><strong>Nombre:</strong> {{ $bariatria->paciente->nombre }}</p>
        <p><strong>Fecha de evaluación:</strong> {{ date('d/m/Y', strtotime($bariatria->fecha)) }}</p>
    </section>

    <section>
        <h2>Datos Antropométricos</h2>
        <table class="datos-antropometricos">
            <tr>
                <th>Medida</th>
                <th>Valor</th>
                <th>Unidad</th>
            </tr>
            <tr>
                <td>Peso</td>
                <td>{{ $bariatria->peso }}</td>
                <td>kg</td>
            </tr>
            <tr>
                <td>Talla</td>
                <td>{{ $bariatria->talla }}</td>
                <td>cm</td>
            </tr>
            <tr>
                <td>Circunferencia de Cintura (CCI)</td>
                <td>{{ $bariatria->cci }}</td>
                <td>cm</td>
            </tr>
            <tr>
                <td>Circunferencia de Cadera (CCA)</td>
                <td>{{ $bariatria->cca }}</td>
                <td>cm</td>
            </tr>
            <tr>
                <td>Circunferencia de Cuello (CCU)</td>
                <td>{{ $bariatria->ccu }}</td>
                <td>cm</td>
            </tr>
            <tr>
                <td>Índice de Masa Corporal (IMC)</td>
                <td>{{ $bariatria->imc }}</td>
                <td>kg/m²</td>
            </tr>
            <tr>
                <td>Índice Cintura Cadera (ICC)</td>
                <td>{{ $bariatria->icc }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Índice Cintura Talla (ICT)</td>
                <td>{{ $bariatria->ict }}</td>
                <td></td>
            </tr>
        </table>
    </section>

    <section>
        <h2>Diagnóstico</h2>
        <div>{!! $bariatria->diagnostico !!}</div>
    </section>

    <section>
        <h2>Plan Terapéutico</h2>
        <p><strong>Kilocalorias:</strong> {{ $bariatria->kilocalorias }}</p>

        <h3>Medicamentos</h3>
        <div>{!! $bariatria->medicamentos !!}</div>

        <h3>Suplementación</h3>
        <div>{!! $bariatria->suplementacion !!}</div>

        <h3>Ejercicios Recomendados</h3>
        <div>{!! $bariatria->ejercicios !!}</div>
    </section>

    @if($bariatria->comentarios)
    <section>
        <h2>Comentarios Adicionales</h2>
        <div>{!! $bariatria->comentarios !!}</div>
    </section>
    @endif

    <footer>
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
    </footer>
</body>

</html>
