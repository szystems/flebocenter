@php
    use Carbon\Carbon;
@endphp

@extends('layouts.admin')

@section('content')
    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-calendar-week"></i>
                </div>
                <div class="page-title">
                    <h5>Agenda de Citas</h5>
                </div>
            </div>
            <!-- Date range start -->
            <div class="d-flex align-items-center">
                <button class="btn btn-primary me-2" id="btnHoy">Hoy</button>
                <form action="{{ route('agenda') }}" method="get" class="d-flex">
                    <button type="submit" name="mes" value="{{ $mesAnterior->month }}"
                            class="btn btn-outline-primary me-1">
                        <input type="hidden" name="anio" value="{{ $mesAnterior->year }}">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <h5 class="mb-0 mx-3">{{ ucfirst($nombreMes) }} {{ $anio }}</h5>
                    <button type="submit" name="mes" value="{{ $mesSiguiente->month }}"
                            class="btn btn-outline-primary ms-1">
                        <input type="hidden" name="anio" value="{{ $mesSiguiente->year }}">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </form>
            </div>
            <!-- Date range end -->
        </div>
        <!-- Main header ends -->

        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4>Calendario de Citas</h4>
                                </div>
                                <div class="col-md-4 text-end">
                                    <button type="button" class="btn btn-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#crearCitaModal">
                                        <i class="bi bi-plus-circle"></i> Nueva Cita
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Calendario -->
                            <div class="table-responsive">
                                <table class="table table-bordered calendar-table">
                                    <thead>
                                        <tr>
                                            <th>Lunes</th>
                                            <th>Martes</th>
                                            <th>Miércoles</th>
                                            <th>Jueves</th>
                                            <th>Viernes</th>
                                            <th>Sábado</th>
                                            <th>Domingo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $day = $inicioCalendario->copy();
                                        @endphp

                                        @while ($day <= $finCalendario)
                                            <tr>
                                                @for ($i = 0; $i < 7; $i++)
                                                    @php
                                                        $fechaActual = $day->format('Y-m-d');
                                                        $esHoy = $fechaActual == Carbon::now()->format('Y-m-d');
                                                        $esMesActual = $day->month == $mes;
                                                        $citasDelDia = $citasPorDia[$fechaActual] ?? null;
                                                    @endphp

                                                    <td class="calendar-day {{ $esHoy ? 'today' : '' }} {{ !$esMesActual ? 'other-month' : '' }}"
                                                        data-fecha="{{ $fechaActual }}">
                                                        <div class="calendar-day-header">
                                                            {{ $day->format('d') }}
                                                        </div>

                                                        @if ($citasDelDia)
                                                            <div class="calendar-day-content">
                                                                <a href="{{ route('agenda.dia', ['fecha' => $fechaActual]) }}"
                                                                   class="calendar-day-citas">
                                                                    <span class="badge bg-secondary">{{ $citasDelDia['total'] }} citas</span>

                                                                    @if ($citasDelDia['Pendiente'] > 0)
                                                                        <span class="badge bg-warning">{{ $citasDelDia['Pendiente'] }} pend.</span>
                                                                    @endif

                                                                    @if ($citasDelDia['Confirmada'] > 0)
                                                                        <span class="badge bg-success">{{ $citasDelDia['Confirmada'] }} conf.</span>
                                                                    @endif

                                                                    @if ($citasDelDia['Atendida'] > 0)
                                                                        <span class="badge bg-info">{{ $citasDelDia['Atendida'] }} atend.</span>
                                                                    @endif
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="calendar-day-content">
                                                                <a href="{{ route('agenda.dia', ['fecha' => $fechaActual]) }}"
                                                                   class="calendar-day-empty">
                                                                    <i class="bi bi-plus-circle text-muted"></i>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </td>

                                                    @php
                                                        $day->addDay();
                                                    @endphp
                                                @endfor
                                            </tr>
                                        @endwhile
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
        </div>
        <!-- Content wrapper end -->

        <!-- Modal para crear cita -->
        @include('admin.agenda.partials.modal-crear-cita')
    </div>
    <!-- Content wrapper scroll end -->
@endsection

@section('styles')
<style>
    .calendar-table {
        table-layout: fixed;
    }

    .calendar-day {
        height: 100px;
        padding: 5px;
        vertical-align: top;
    }

    .calendar-day-header {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .calendar-day-content {
        font-size: 0.9em;
    }

    .calendar-day-citas {
        display: flex;
        flex-direction: column;
        gap: 2px;
        text-decoration: none;
    }

    .calendar-day-empty {
        display: block;
        text-align: center;
        padding: 10px 0;
        text-decoration: none;
    }

    .today {
        background-color: rgba(0, 123, 255, 0.1);
        border: 2px solid #007bff;
    }

    .other-month {
        background-color: #f8f9fa;
        color: #adb5bd;
    }

    .badge {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Botón para ir al día actual
        document.getElementById('btnHoy').addEventListener('click', function() {
            window.location.href = "{{ route('agenda') }}";
        });

        // Inicialización del select2 para los dropdown
        if (typeof $.fn.select2 !== 'undefined') {
            $('.select2').select2({
                dropdownParent: $('#crearCitaModal')
            });
        }

        // Manejar cambio de doctor y fechas para verificar disponibilidad
        $('#doctor_id, #clinica_id, #fecha_cita').on('change', verificarDisponibilidad);

        function verificarDisponibilidad() {
            const doctorId = $('#doctor_id').val();
            const clinicaId = $('#clinica_id').val();
            const fechaCita = $('#fecha_cita').val();

            if (doctorId && clinicaId && fechaCita) {
                $.ajax({
                    url: '{{ route("agenda.disponibilidad") }}',
                    type: 'GET',
                    data: {
                        doctor_id: doctorId,
                        clinica_id: clinicaId,
                        fecha: fechaCita,
                        cita_id: $('#cita_id').val()
                    },
                    success: function(response) {
                        // Mostrar horas ocupadas en la interfaz
                        const citasOcupadas = response.citas;

                        if(citasOcupadas.length > 0) {
                            $('#horarios-ocupados').removeClass('d-none');
                            let horariosHTML = '<ul>';
                            citasOcupadas.forEach(function(cita) {
                                horariosHTML += `<li>${cita.hora_inicio.substring(0, 5)} - ${cita.hora_fin.substring(0, 5)}</li>`;
                            });
                            horariosHTML += '</ul>';
                            $('#lista-horarios-ocupados').html(horariosHTML);
                        } else {
                            $('#horarios-ocupados').addClass('d-none');
                        }
                    },
                    error: function(error) {
                        console.error('Error al verificar disponibilidad:', error);
                    }
                });
            }
        }
    });
</script>
@endsection
