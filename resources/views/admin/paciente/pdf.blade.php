<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pure css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css"
        integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">


    <title>{{ __('Pacientes') }}</title>

</head>

<body>
    <center>
        <img align="center" src="{{ $imagen }}" alt="" height="100">
    </center>
    <h3 align="center"><u>{{ __('Pacientes') }}</u></h3>
    <label>
        <font size="1">{{ __('Fecha Reporte:') }}:</font>
        <font color="blue" size="1">
            @php
                $horafecha = now();
                $horafecha = $horafecha->format('d-m-Y, H:i:s')
            @endphp
            {{ $horafecha }}
        </font>
    </label>
    <br>

    <h5><u>{{ __('Listado de Pacientes') }}:</u></h5>
    <table class="pure-table pure-table-bordered" Width=100%>
        <thead>
            <tr>
                <th>
                    <font size="1">Paciente</font>
                </th>
                <th>
                    <font size="1">{{ __('Fecha Nacimiento') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('Nit') }}</font>
                </th>
                <th>
                    <font size="1">{{ __('DPI') }}</font>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
                <tr>
                    <td align="left">
                        <font size="1">
                            <b>{{ $paciente->nombre }}</b>
                            <br>
                            {{ $paciente->telefono }} {{ $paciente->celular }}
                            <br>
                            {{ $paciente->email }}
                            <br>
                            {{ $paciente->direccion }}
                        </font>
                    </td>

                    <td align="center">
                        @php
                            $today = now();
                            $fecha_naciemiento = date("d/m/Y", strtotime($paciente->fecha_naciemiento));
                        @endphp
                        <font size="1">
                            @php
                                $fnacimiento = null;
                                $edad = 0;
                                if ($paciente->fecha_nacimiento != null) {
                                    $fnacimiento = date("d-m-Y", strtotime($paciente->fecha_nacimiento));
                                    //calcular edad
                                    $fecha_nacimiento = date("d-m-Y", strtotime($paciente->fecha_nacimiento));
                                    $cumpleanos = new DateTime($paciente->fecha_nacimiento);
                                    $hoy = new DateTime();
                                    $annos = $hoy->diff($cumpleanos);
                                    $edad = $annos->y;
                                }

                            @endphp
                            {{ $fecha_naciemiento }}
                            @if ($edad > 0)
                            <br>
                                ({{ $edad }} Años)
                            @endif
                        </font>
                    </td>
                    <td align="left">
                        <font size="1">{{ $paciente->nit }}</font>
                    </td>
                    <td align="left">
                        <font size="1">{{ $paciente->dpi }}</font>
                    </td>


                </tr>
            @endforeach

        </tbody>

    </table>


</body>

</html>
