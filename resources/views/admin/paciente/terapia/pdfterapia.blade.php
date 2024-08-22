<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terapia</title>
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
        <h1><u>Terapia de Drenaje Linfático</u></h1>
        @php
            $horafecha = new DateTime("now", new DateTimeZone('America/Guatemala'));
            $horafecha = $horafecha->format('d/m/Y')
        @endphp
        <p align="left"><font size="1">Fecha de impresion: {{ $horafecha }}</font></p>
    </header>
    <section>
        <h2>Paciente</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Ocupación</th>
                    <th>Nacimiento</th>
                    <th>Sexo</th>
                    <th>Tel./Cel.</th>
                    <th>Email</th>
                    <th>DPI</th>
                    <th>NIT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><font size="1">{{ $terapia->paciente->nombre }}</font></td>
                    <td><font size="1">{{ $terapia->paciente->ocupacion }}</font></td>
                    @php
                        $fnacimiento = null;
                        $edad = 0;
                        if ($terapia->paciente->fecha_nacimiento != null) {
                            $fnacimiento = date("d/m/Y", strtotime($terapia->paciente->fecha_nacimiento));
                            //calcular edad
                            $fecha_nacimiento = date("d-m-Y", strtotime($terapia->paciente->fecha_nacimiento));
                            $cumpleanos = new DateTime($terapia->paciente->fecha_nacimiento);
                            $hoy = new DateTime();
                            $annos = $hoy->diff($cumpleanos);
                            $edad = $annos->y;
                        }

                    @endphp
                    <td><font size="1">{{ $fnacimiento }} ({{ $edad }} años)</font></td>
                    <td><font size="1">{{ $terapia->paciente->sexo }}</font></td>
                    <td><font size="1">{{ $terapia->paciente->telefono }} / {{ $terapia->paciente->celular }}</font></td>
                    <td><font size="1">{{ $terapia->paciente->email }}</font></td>
                    <td><font size="1">{{ $terapia->paciente->dpi }}</font></td>
                    <td><font size="1">{{ $terapia->paciente->nit }}</font></td>
                </tr>
            </tbody>
        </table>
    </section>
    <section>
        <h2>Terapia</h2>
        <table class="table">
            <thead>

                <tr>
                    <th>Fecha Inicio:</th>
                    @php
                        $fechainicio = date('d/m/Y', strtotime($terapia->created_at));
                    @endphp
                    <td>{{ $fechainicio }}</td>
                    <th>Ultima Terapia:</th>
                    @php
                        $fechaultima = date('d/m/Y', strtotime($terapia->updated_at));
                    @endphp
                    <td>{{ $fechaultima }}</td>
                </tr>
                <tr>
                    <th>Elastocompresión</th>
                    <td colspan="3">{{ $terapia->talla_media }}</td>
                </tr>
                <tr>
                    <th>Diagnostico</th>
                    <td colspan="3">{{ $terapia->diagnostico }}</td>
                </tr>
                <tr>
                    <th>Observaciones</th>
                    <td colspan="3">{{ $terapia->observaciones }}</td>
                </tr>

            </thead>
        </table>
        <!-- Other sections... -->
    </section>
    <section>
        <h2>Sesiones Miembro Inferior Izquierdo</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th colspan="4">Antes</th>
                    <th colspan="4">Despues</th>
                </tr>
            </thead>
            <tbody>
                @if ($miembroIzquierdo->count() == 0)
                    <tr>
                        <td colspan="9">
                            <font color="orange">No hay sesiones.</font>
                        </td>
                    </tr>
                @else
                    @foreach ($miembroIzquierdo as $sesion)
                        <tr>
                            <td>
                                <font size="1">
                                    @php
                                        $fechacreated = date('d/m/Y', strtotime($sesion->created_at));
                                        $fechaupdated = date('d/m/Y', strtotime($sesion->updated_at));
                                    @endphp
                                    <p><font color="blue">{{ $fechacreated }}</font> - <font color="limegreen">{{ $fechacreated }}</font> </p>
                                </font>
                            </td>
                            <td><font size="1" color="orange">{{ $sesion->antes1 }}</font></td>
                            <td><font size="1" color="orange">{{ $sesion->antes2 }}</font></td>
                            <td><font size="1" color="orange">{{ $sesion->antes3 }}</font></td>
                            <td><font size="1" color="orange">{{ $sesion->antes4 }}</font></td>
                            <td><font size="1" color="limegreen">{{ $sesion->despues1 }}</font></td>
                            <td><font size="1" color="limegreen">{{ $sesion->despues2 }}</font></td>
                            <td><font size="1" color="limegreen">{{ $sesion->despues3 }}</font></td>
                            <td><font size="1" color="limegreen">{{ $sesion->despues4 }}</font></td>

                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </section>

    <section>
        <h2>Sesiones Miembro Inferior Derecho</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th colspan="4">Antes</th>
                    <th colspan="4">Despues</th>
                </tr>
            </thead>
            <tbody>
                @if ($miembroDerecha->count() == 0)
                    <tr>
                        <td colspan="9">
                            <font color="orange">No hay sesiones.</font>
                        </td>
                    </tr>
                @else
                    @foreach ($miembroDerecha as $sesion)
                        <tr>
                            <td>
                                <font size="1">
                                    @php
                                        $fechacreated = date('d/m/Y', strtotime($sesion->created_at));
                                        $fechaupdated = date('d/m/Y', strtotime($sesion->updated_at));
                                    @endphp
                                    <p><font color="blue">{{ $fechacreated }}</font> - <font color="limegreen">{{ $fechacreated }}</font> </p>
                                </font>
                            </td>
                            <td><font size="1" color="orange">{{ $sesion->antes1 }}</font></td>
                            <td><font size="1" color="orange">{{ $sesion->antes2 }}</font></td>
                            <td><font size="1" color="orange">{{ $sesion->antes3 }}</font></td>
                            <td><font size="1" color="orange">{{ $sesion->antes4 }}</font></td>
                            <td><font size="1" color="limegreen">{{ $sesion->despues1 }}</font></td>
                            <td><font size="1" color="limegreen">{{ $sesion->despues2 }}</font></td>
                            <td><font size="1" color="limegreen">{{ $sesion->despues3 }}</font></td>
                            <td><font size="1" color="limegreen">{{ $sesion->despues4 }}</font></td>

                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </section>

</body>

</html>
