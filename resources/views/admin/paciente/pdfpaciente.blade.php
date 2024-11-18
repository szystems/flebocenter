<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paciente</title>
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
        <h1><u>Paciente</u></h1>
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
                    <th align="right">Nombre:</th>
                    <td colspan="5">{{ $paciente->nombre }}</td>
                </tr>
                <tr>
                    <th align="right">Ocupacíon</th>
                    <td>{{ $paciente->ocupacion }}</td>
                    <th align="right">Fecha Nacimiento:</th>
                    @php
                        $fnacimiento = null;
                        $edad = 0;
                        if ($paciente->fecha_nacimiento != null) {
                            $fnacimiento = date("d/m/Y", strtotime($paciente->fecha_nacimiento));
                            //calcular edad
                            $fecha_nacimiento = date("d-m-Y", strtotime($paciente->fecha_nacimiento));
                            $cumpleanos = new DateTime($paciente->fecha_nacimiento);
                            $hoy = new DateTime();
                            $annos = $hoy->diff($cumpleanos);
                            $edad = $annos->y;
                        }

                    @endphp
                    <td>{{ $fnacimiento }}  ({{ $edad }} años)</td>
                    <th align="right">Sexo</th>
                    <td>{{ $paciente->sexo }}</td>
                </tr>
                <tr>
                    <th align="right">Teléfonos</th>
                    <td>{{ $paciente->telefono }} / {{ $paciente->celular }}</td>
                    <th align="right">Email</th>
                    <td colspan="3">{{ $paciente->email }}</td>
                </tr>
                <tr>
                    <th align="right">DPI</th>
                    <td>{{ $paciente->dpi }}</td>
                    <th align="right">NIT</th>
                    <td colspan="3">{{ $paciente->nit }}</td>
                </tr>
                <tr>
                    <th align="right">Dirección</th>
                    <td>{{ $paciente->direccion }}</td>
                </tr>
                @if ($paciente->fotografia != null)
                <tr>
                    <th align="right">Imagen:</th>
                    <td align="center" colspan="5">
                        <img src="{{$pathpaciente.$paciente->fotografia}}" style="max-height: 200px; width: auto;"/>
                    </td>
                </tr>
                @endif
                @php
                    $fnacimiento = date("d/m/Y", strtotime($paciente->fecha_nacimiento));
                @endphp


                <tr>
                    <th align="right">Fecha Primera Cita:</th>
                    @php
                        $fprimeracita = date("d/m/Y", strtotime($paciente->fecha_primera_cita));
                    @endphp
                    <td>{{ $fprimeracita }}</td>

                </tr>
                <tr>
                    <th align="right">Enviado Por Medico:</th>
                    <td colspan="5">{{ $paciente->enviado_por_medico }}</td>
                </tr>




            </thead>
        </table>
        <!-- Other sections... -->
    </section>


</body>

</html>
