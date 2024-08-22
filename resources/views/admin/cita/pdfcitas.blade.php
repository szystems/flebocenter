<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Citas</title>
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
        <h1><u>Citas</u></h1>
        @php
            $horafecha = new DateTime("now", new DateTimeZone('America/Guatemala'));
            $horafecha = $horafecha->format('d/m/Y')
        @endphp
        <p align="left"><font size="1">Fecha de impresion: {{ $horafecha }}</font></p>
    </header>
    <section>
        <h2>Listado de citas del: <font color="blue">{{ date('d/m/Y', strtotime($request->input('fecha_imprimir'))) }}</font></h2>
        <p class="m-0 fw-normal">
            <hr>
            <strong><u>Filtros:</u></strong>
            <br>
            <small>
                @if ($request->input('fecha_imprimir'))
                    <strong>Fecha: </strong><font color="Blue">{{ date('d/m/Y', strtotime($request->input('fecha_imprimir'))) }}</font>
                @endif
                @if (request('estado_imprimir'))
                    <strong>Estado:  </strong><font color="Blue">{{ request('estado_imprimir') }}</font>
                @endif
                @if (request('clinica_imprimir'))
                    @php
                        $clinica = \App\Models\Clinica::find(request('clinica_imprimir'));
                    @endphp
                    <strong>Clinica:  </strong><font color="Blue">{{ $clinica->nombre }}</font>
                @endif
                @if (request('doctor_imprimir'))
                    @php
                        $doctor = \App\Models\User::find(request('doctor_imprimir'));
                    @endphp
                    <strong>Doctor:  </strong><font color="Blue">{{ $doctor->name }}</font>
                @endif
                @if (request('paciente_imprimir'))
                    <strong>Paciente:  </strong><font color="Blue">{{ request('paciente_imprimir') }}</font>
                @endif
            </small>
            <hr>
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Clinica</th>
                    <th>Doctor</th>
                    <th>Paciente</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                    <tr>
                        <td><font size="1">
                            @php
                                $hi = date('h:i A', strtotime($cita->hora_inicio));
                                $hf = date('h:i A', strtotime($cita->hora_fin));
                            @endphp
                            <font size="1">{{ $hi }} - {{ $hf }}</font>
                        </td>
                        <td>
                            <font size="1"
                            color="{{ $cita->estado == "Pendiente" ? 'orange'
                                : ($cita->estado == "Confirmada" ? 'blue'
                                : ($cita->estado == "Atendida" ? 'limegreen'
                                : ""))
                            }}">
                                {{ $cita->estado }}
                            </font>
                        </td>
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
                @endforeach
            </tbody>
        </table>
    </section>


</body>

</html>
