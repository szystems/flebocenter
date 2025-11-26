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
                    <i class="bi bi-calendar-day"></i>
                </div>
                <div class="page-title">
                    <h5>Agenda del día: {{ $fechaCarbon->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</h5>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('agenda') }}" class="btn btn-outline-primary me-2">
                    <i class="bi bi-calendar-month"></i> Calendario
                </a>
                <div class="btn-group me-2">
                    <a href="{{ route('agenda.dia', ['fecha' => $fechaCarbon->copy()->subDay()->format('Y-m-d')]) }}"
                       class="btn btn-outline-secondary">
                        <i class="bi bi-chevron-left"></i> Día anterior
                    </a>
                    <a href="{{ route('agenda.dia', ['fecha' => Carbon::now()->format('Y-m-d')]) }}"
                       class="btn btn-outline-primary mx-1">
                        <i class="bi bi-calendar-check"></i> Hoy
                    </a>
                    <a href="{{ route('agenda.dia', ['fecha' => $fechaCarbon->copy()->addDay()->format('Y-m-d')]) }}"
                       class="btn btn-outline-secondary">
                        Siguiente día <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearCitaModal">
                    <i class="bi bi-plus-circle"></i> Nueva Cita
                </button>
            </div>
        </div>
        <!-- Main header ends -->

        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <!-- Leyenda de estados -->
            <div class="card mb-3">
                <div class="card-body py-2">
                    <div class="d-flex justify-content-center flex-wrap">
                        <div class="mx-2 mb-2">
                            <span class="estado-badge estado-confirmada"></span> Confirmada
                        </div>
                        <div class="mx-2 mb-2">
                            <span class="estado-badge estado-pendiente"></span> Pendiente
                        </div>
                        <div class="mx-2 mb-2">
                            <span class="estado-badge estado-atendida"></span> Atendida
                        </div>
                        <div class="mx-2 mb-2">
                            <span class="estado-badge estado-disponible"></span> Disponible
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pestañas de doctores -->
            <div class="card mb-3">
                <div class="card-body p-0">
                    <ul class="nav nav-tabs" id="doctorTabs" role="tablist">
                        @foreach($filtroDoctores as $index => $doctor)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $index === 0 ? 'active' : '' }}" id="doctor-tab-{{ $doctor->id }}" data-bs-toggle="tab"
                                data-bs-target="#doctor-{{ $doctor->id }}" type="button" role="tab"
                                aria-controls="doctor-{{ $doctor->id }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                <i class="bi bi-person"></i> Dr. {{ explode(' ', $doctor->name)[0] }}
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Contenido de las pestañas -->
            <div class="tab-content" id="doctorTabsContent">
                <!-- Una pestaña por doctor -->
                @foreach($filtroDoctores as $index => $doctor)
                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="doctor-{{ $doctor->id }}" role="tabpanel" aria-labelledby="doctor-tab-{{ $doctor->id }}">
                    <div class="card">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="bi bi-person-vcard me-2"></i>Dr. {{ $doctor->name }}
                            </h5>
                            <!-- Leyenda de clínicas -->
                            <div class="clinic-legend d-flex flex-wrap">
                                @foreach($filtroClinicas as $clinica)
                                    <span class="badge border border-secondary me-2 mb-1">
                                        <span class="clinic-dot clinic-{{ $clinica->id }}"></span>
                                        {{ $clinica->nombre }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table schedule-table table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 80px">Hora</th>
                                            @foreach($filtroClinicas as $clinica)
                                                <th class="text-center">
                                                    <span class="clinic-dot clinic-{{ $clinica->id }}"></span>
                                                    {{ $clinica->nombre }}
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Intervalos de tiempo -->
                                        @for($hora = 7; $hora <= 19; $hora++)
                                            <!-- Hora completa -->
                                            <tr>
                                                <td class="time-cell">{{ sprintf('%02d:00', $hora) }}</td>

                                                @foreach($filtroClinicas as $clinica)
                                                    <td class="schedule-cell">
                                                        @php
                                                            $horaCompleta = sprintf('%02d:00', $hora);

                                                            // Buscar citas para esta hora específica, doctor y clínica
                                                            $citaExistente = null;
                                                            foreach($citas as $cita) {
                                                                if($cita->doctor_id == $doctor->id &&
                                                                   $cita->clinica_id == $clinica->id &&
                                                                   substr($cita->hora_inicio, 0, 5) == $horaCompleta) {
                                                                    $citaExistente = $cita;
                                                                    break;
                                                                }
                                                            }
                                                        @endphp

                                                        @if($citaExistente)
                                                            <div class="appointment appointment-{{ strtolower($citaExistente->estado) }}">
                                                                <div class="appointment-info" onclick="verCita({{ $citaExistente->id }})">
                                                                    <strong>{{ substr($citaExistente->hora_inicio, 0, 5) }}</strong> - {{ $citaExistente->paciente->nombre }}
                                                                </div>
                                                                <div class="appointment-actions">
                                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="verCita({{ $citaExistente->id }})">
                                                                        <i class="bi bi-eye"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="editarCita({{ $citaExistente->id }})">
                                                                        <i class="bi bi-pencil"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="eliminarCita({{ $citaExistente->id }})">
                                                                        <i class="bi bi-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <button type="button" class="btn btn-sm btn-outline-light w-100 h-100"
                                                                   onclick="nuevaCita('{{ $doctor->id }}', '{{ $clinica->id }}', '{{ $fecha }}', '{{ $horaCompleta }}')">
                                                                <i class="bi bi-plus-circle"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>

                                            <!-- Media hora -->
                                            <tr class="half-hour-row">
                                                <td class="time-cell">{{ sprintf('%02d:30', $hora) }}</td>

                                                @foreach($filtroClinicas as $clinica)
                                                    <td class="schedule-cell">
                                                        @php
                                                            $mediaHora = sprintf('%02d:30', $hora);

                                                            // Buscar citas para esta media hora específica, doctor y clínica
                                                            $citaExistente = null;
                                                            foreach($citas as $cita) {
                                                                if($cita->doctor_id == $doctor->id &&
                                                                   $cita->clinica_id == $clinica->id &&
                                                                   substr($cita->hora_inicio, 0, 5) == $mediaHora) {
                                                                    $citaExistente = $cita;
                                                                    break;
                                                                }
                                                            }
                                                        @endphp

                                                        @if($citaExistente)
                                                            <div class="appointment appointment-{{ strtolower($citaExistente->estado) }}">
                                                                <div class="appointment-info" onclick="verCita({{ $citaExistente->id }})">
                                                                    <strong>{{ substr($citaExistente->hora_inicio, 0, 5) }}</strong> - {{ $citaExistente->paciente->nombre }}
                                                                </div>
                                                                <div class="appointment-actions">
                                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="verCita({{ $citaExistente->id }})">
                                                                        <i class="bi bi-eye"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="editarCita({{ $citaExistente->id }})">
                                                                        <i class="bi bi-pencil"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="eliminarCita({{ $citaExistente->id }})">
                                                                        <i class="bi bi-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <button type="button" class="btn btn-sm btn-outline-light w-100 h-100"
                                                                   onclick="nuevaCita('{{ $doctor->id }}', '{{ $clinica->id }}', '{{ $fecha }}', '{{ $mediaHora }}')">
                                                                <i class="bi bi-plus-circle"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Content wrapper end -->

        <!-- Modales para gestión de citas -->
        @include('admin.agenda.partials.modal-crear-cita')
        @include('admin.agenda.partials.modal-editar-cita')
        @include('admin.agenda.partials.modal-ver-cita')

        <!-- Modal de confirmación para eliminar cita -->
        <div class="modal fade" id="eliminarCitaModal" tabindex="-1" aria-labelledby="eliminarCitaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminarCitaModalLabel">Confirmar eliminación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Está seguro que desea eliminar esta cita?</p>
                        <p>Esta acción no se puede deshacer.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form id="formEliminarCita" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar cita</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content wrapper scroll end -->
@endsection

@section('styles')
<style>
    /* Estilo para estados de citas */
    .estado-badge {
        display: inline-block;
        width: 20px;
        height: 20px;
        border-radius: 4px;
        margin-right: 5px;
        vertical-align: middle;
    }

    .estado-confirmada {
        background-color: #198754;
    }

    .estado-pendiente {
        background-color: #ffc107;
    }

    .estado-atendida {
        background-color: #0dcaf0;
    }

    .estado-disponible {
        background-color: #f8f9fa;
        border: 1px dashed #adb5bd;
    }

    /* Estilos para la tabla de horarios */
    .schedule-table {
        table-layout: fixed;
        border-collapse: collapse;
    }

    .schedule-table thead th {
        position: sticky;
        top: 0;
        background-color: #f8f9fa;
        z-index: 2;
    }

    .time-cell {
        font-weight: bold;
        font-size: 0.85rem;
        text-align: center;
        vertical-align: middle;
        background-color: #f8f9fa;
        color: #495057;
    }

    .schedule-cell {
        padding: 2px !important;
        height: 46px;
        vertical-align: middle;
        position: relative;
    }

    .half-hour-row {
        background-color: rgba(0,0,0,0.02);
    }

    .half-hour-row .time-cell {
        background-color: #f0f0f0;
        font-size: 0.75rem;
    }

    /* Estilos para las citas */
    .appointment {
        position: relative;
        border-radius: 4px;
        padding: 5px;
        height: 100%;
        cursor: pointer;
        overflow: hidden;
    }

    .appointment-info {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .appointment-confirmada {
        background-color: #198754;
        color: white;
    }

    .appointment-pendiente {
        background-color: #ffc107;
        color: #212529;
    }

    .appointment-atendida {
        background-color: #0dcaf0;
        color: #212529;
    }

    .appointment-actions {
        position: absolute;
        top: 2px;
        right: 2px;
        display: none;
    }

    .appointment:hover .appointment-actions {
        display: flex;
    }

    /* Botón para agregar citas */
    .btn-outline-light {
        border: 1px dashed #dee2e6;
        font-size: 1.2rem;
        opacity: 0.5;
        transition: all 0.2s;
        min-height: 40px;
    }

    .btn-outline-light:hover {
        opacity: 1;
        background-color: rgba(0, 123, 255, 0.1);
        border-color: #6c757d;
    }

    /* Punto indicador de clínica */
    .clinic-dot {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 5px;
        vertical-align: middle;
    }

    /* Colores para las clínicas */
    .clinic-1 { background-color: #4287f5; }
    .clinic-2 { background-color: #f542a7; }
    .clinic-3 { background-color: #42f54b; }
    .clinic-4 { background-color: #f5d742; }
    .clinic-5 { background-color: #f54242; }
    .clinic-6 { background-color: #42f5f5; }
    .clinic-7 { background-color: #8d42f5; }
    .clinic-8 { background-color: #f59b42; }
    .clinic-9 { background-color: #7af542; }
    .clinic-10 { background-color: #f542eb; }
</style>
@endsection

@section('scripts')
<script>
    // Función para crear nueva cita (botón +)
    function nuevaCita(doctorId, clinicaId, fecha, horaInicio) {
        console.log('Nueva cita:', doctorId, clinicaId, fecha, horaInicio);

        // Calcular hora fin (30 minutos después)
        let [horas, minutos] = horaInicio.split(':');
        let horaFinDate = new Date();
        horaFinDate.setHours(parseInt(horas));
        horaFinDate.setMinutes(parseInt(minutos) + 30);
        const horaFin = `${String(horaFinDate.getHours()).padStart(2, '0')}:${String(horaFinDate.getMinutes()).padStart(2, '0')}`;

        // Establecer valores en el modal
        document.getElementById('doctor_id').value = doctorId;
        if (typeof $('#doctor_id').select2 !== 'undefined') {
            $('#doctor_id').trigger('change');
        }

        document.getElementById('clinica_id').value = clinicaId;
        if (typeof $('#clinica_id').select2 !== 'undefined') {
            $('#clinica_id').trigger('change');
        }

        document.getElementById('fecha_cita').value = fecha;
        document.getElementById('hora_inicio').value = horaInicio;
        document.getElementById('hora_fin').value = horaFin;

        // Mostrar el modal manualmente
        var myModal = new bootstrap.Modal(document.getElementById('crearCitaModal'));
        myModal.show();
    }

    // Función para ver detalles de una cita
    function verCita(citaId) {
        console.log('Ver cita:', citaId);

        // Realizar petición AJAX para obtener datos de la cita
        $.ajax({
            url: '{{ url("show-cita") }}/' + citaId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log('Datos de cita recibidos:', data);
                if (data.cita) {
                    const cita = data.cita;

                    // Llenar datos en el modal
                    document.getElementById('ver-paciente').textContent = cita.paciente.nombre;
                    document.getElementById('ver-doctor').textContent = 'Dr. ' + cita.doctor.name;
                    document.getElementById('ver-clinica').textContent = cita.clinica.nombre;
                    document.getElementById('ver-fecha').textContent = formatearFecha(cita.fecha_cita);
                    document.getElementById('ver-horario').textContent = cita.hora_inicio.substring(0, 5) + ' - ' + cita.hora_fin.substring(0, 5);
                    document.getElementById('ver-motivo').textContent = cita.motivo || 'Sin motivo registrado';

                    // Mostrar estado con la clase correcta
                    let estadoHTML = '';
                    if (cita.estado === 'Pendiente') {
                        estadoHTML = '<span class="badge bg-warning">Pendiente</span>';
                    } else if (cita.estado === 'Confirmada') {
                        estadoHTML = '<span class="badge bg-success">Confirmada</span>';
                    } else {
                        estadoHTML = '<span class="badge bg-info">Atendida</span>';
                    }
                    document.getElementById('ver-estado').innerHTML = estadoHTML;

                    // Abrir el modal manualmente
                    var myModal = new bootstrap.Modal(document.getElementById('verCitaModal'));
                    myModal.show();
                } else {
                    toastr.error('No se pudo cargar la información de la cita');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar datos de cita:', error);
                console.error('Estado:', status);
                console.error('Respuesta:', xhr.responseText);
                toastr.error('Error al cargar la información de la cita');
            }
        });
    }

    // Función para editar una cita
    function editarCita(citaId) {
        console.log('Editar cita:', citaId);

        // Realizar petición AJAX para obtener datos de la cita
        $.ajax({
            url: '{{ url("show-cita") }}/' + citaId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log('Datos de cita para editar:', data);
                if (data.cita) {
                    const cita = data.cita;

                    // Llenar formulario de edición
                    document.getElementById('cita_id').value = cita.id;

                    // Manejar los campos select con y sin select2
                    document.getElementById('paciente_id').value = cita.paciente_id;
                    document.getElementById('doctor_id_editar').value = cita.doctor_id;
                    document.getElementById('clinica_id_editar').value = cita.clinica_id;

                    if (typeof $('#paciente_id').select2 !== 'undefined') {
                        $('#paciente_id').trigger('change');
                    }
                    if (typeof $('#doctor_id_editar').select2 !== 'undefined') {
                        $('#doctor_id_editar').trigger('change');
                    }
                    if (typeof $('#clinica_id_editar').select2 !== 'undefined') {
                        $('#clinica_id_editar').trigger('change');
                    }

                    document.getElementById('fecha_cita_editar').value = cita.fecha_cita;
                    document.getElementById('hora_inicio_editar').value = cita.hora_inicio.substring(0, 5);
                    document.getElementById('hora_fin_editar').value = cita.hora_fin.substring(0, 5);
                    document.getElementById('estado_editar').value = cita.estado;
                    document.getElementById('motivo_editar').value = cita.motivo;

                    // Abrir el modal manualmente
                    var myModal = new bootstrap.Modal(document.getElementById('editarCitaModal'));
                    myModal.show();
                } else {
                    toastr.error('No se pudo cargar la información de la cita');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar datos de cita para editar:', error);
                console.error('Estado:', status);
                console.error('Respuesta:', xhr.responseText);
                toastr.error('Error al cargar la información de la cita');
            }
        });
    }

    // Función para eliminar una cita
    function eliminarCita(citaId) {
        console.log('Eliminar cita:', citaId);

        // Actualizar el formulario con la URL correcta
        document.getElementById('formEliminarCita').setAttribute('action', '{{ url("agenda/citas") }}/' + citaId);

        // Abrir el modal manualmente
        var myModal = new bootstrap.Modal(document.getElementById('eliminarCitaModal'));
        myModal.show();
    }

    // Formatear fecha para mostrar en español
    function formatearFecha(fechaStr) {
        const fecha = new Date(fechaStr + 'T00:00:00'); // Añadir tiempo para evitar problemas con zona horaria
        const opciones = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return fecha.toLocaleDateString('es-ES', opciones);
    }

    // Inicialización cuando el DOM esté cargado
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM cargado completamente');

        // Inicializar Select2 si está disponible
        if (typeof $.fn.select2 !== 'undefined') {
            $('.select2').select2({
                dropdownParent: $('#crearCitaModal')
            });
            $('.select2-edit').select2({
                dropdownParent: $('#editarCitaModal')
            });
        }
    });
</script>
@endsection
