<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cita</title>
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
        <h1><u>Cita</u></h1>
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
                    <th align="right">Hora/Fecha:</th>
                    <td>
                        @php
                            $hi = date('h:i A', strtotime($cita->hora_inicio));
                            $hf = date('h:i A', strtotime($cita->hora_fin));
                        @endphp
                        <font size="1">{{ $hi }} - {{ $hf }} / <font color="blue"><b>{{ date('d/m/Y', strtotime($cita->fecha_cita)) }}</b></font></font>
                    </td>
                    <th align="right">Estado:</th>
                    <td colspan="3">
                        <font size="1"
                            color="{{ $cita->estado == "Pendiente" ? 'orange'
                                : ($cita->estado == "Confirmada" ? 'blue'
                                : ($cita->estado == "Atendida" ? 'limegreen'
                                : ""))
                            }}">
                                <b>{{ $cita->estado }}</b>
                        </font>
                    </td>
                </tr>
                <tr>
                    <th align="right">Clinica:</th>
                    <td>
                        @php
                            $clinica = \App\Models\Clinica::find($cita->clinica_id);
                        @endphp
                        <font size="1">
                            <strong>{{ $clinica->nombre }}</strong>
                            <br>
                            {{ $clinica->direccion }}
                        </font>
                    </td>
                    <th align="right">Doctor:</th>
                    <td>
                        @php
                            $doctor = \App\Models\User::find($cita->doctor_id);
                        @endphp
                        <font size="1">
                            <strong>{{ $doctor->name }}</strong>
                            <br>
                            {{ $doctor->email }}
                            <br>
                            {{ $doctor->telefono }}
                            @if ($doctor->celular != null)
                            / {{ $doctor->celular }}
                            @endif
                        </font>
                    </td>
                    <th align="right">Paciente:</th>
                    <td>
                        @php
                            $paciente = \App\Models\Paciente::find($cita->paciente_id);
                        @endphp
                        <font size="1">
                            <b>{{ $paciente->nombre }}</b>
                            <br>
                            DPI: {{ $paciente->dpi }}
                            <br>
                            {{ $paciente->email }}
                            <br>
                            {{ $paciente->telefono }}
                            @if ($paciente->celular != null)
                            / {{ $paciente->celular }}
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
