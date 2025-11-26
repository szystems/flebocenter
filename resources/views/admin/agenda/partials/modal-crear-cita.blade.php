@php
    use Carbon\Carbon;
@endphp

<!-- Modal de creación de cita -->
<div class="modal fade" id="crearCitaModal" tabindex="-1" role="dialog" aria-labelledby="crearCitaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearCitaModalLabel">Nueva Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCrearCita" action="{{ url('agenda/citas') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="paciente_id" class="form-label">Paciente</label>
                                <select class="form-control select2" id="paciente_id" name="paciente_id" required>
                                    <option value="">Seleccione un paciente</option>
                                    @foreach($filtroPacientes as $paciente)
                                        <option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->dpi ? '- DPI: '.$paciente->dpi : '' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="doctor_id" class="form-label">Doctor</label>
                                <select class="form-control select2" id="doctor_id" name="doctor_id" required>
                                    <option value="">Seleccione un doctor</option>
                                    @foreach($filtroDoctores as $doctor)
                                        <option value="{{ $doctor->id }}">Dr. {{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="clinica_id" class="form-label">Clínica</label>
                                <select class="form-control select2" id="clinica_id" name="clinica_id" required>
                                    <option value="">Seleccione una clínica</option>
                                    @foreach($filtroClinicas as $clinica)
                                        <option value="{{ $clinica->id }}">{{ $clinica->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fecha_cita" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha_cita" name="fecha_cita"
                                       value="{{ isset($fecha) ? $fecha : Carbon::now()->format('Y-m-d') }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="hora_inicio" class="form-label">Hora inicio</label>
                                        <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="hora_fin" class="form-label">Hora fin</label>
                                        <input type="time" class="form-control" id="hora_fin" name="hora_fin" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-control" id="estado" name="estado" required>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Confirmada">Confirmada</option>
                                    <option value="Atendida">Atendida</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo / Observaciones</label>
                        <textarea class="form-control" id="motivo" name="motivo" rows="3" required></textarea>
                    </div>

                    <div id="horarios-ocupados" class="alert alert-info d-none">
                        <h6>Horarios ocupados para este doctor en esta fecha:</h6>
                        <div id="lista-horarios-ocupados"></div>
                    </div>

                    <div id="error-traslape" class="alert alert-danger d-none">
                        El horario seleccionado se traslapa con otra cita existente.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cita</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Envío del formulario por AJAX
        $('#formCrearCita').submit(function(e) {
            e.preventDefault();

            const form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#error-traslape').addClass('d-none');
                },
                success: function(response) {
                    if (response.success) {
                        // Cerrar modal y refrescar página
                        $('#crearCitaModal').modal('hide');
                        toastr.success(response.message);
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) { // Error de validación
                        const response = xhr.responseJSON;

                        if (response.message && response.message.includes('traslapa')) {
                            $('#error-traslape').removeClass('d-none');
                        } else {
                            let errorMessage = 'Error en el formulario:';

                            if (response.errors) {
                                Object.keys(response.errors).forEach(key => {
                                    errorMessage += '\n- ' + response.errors[key][0];
                                });
                            }

                            toastr.error(errorMessage);
                        }
                    } else {
                        toastr.error('Error al procesar la solicitud.');
                    }
                }
            });
        });

        // Verificar disponibilidad al cambiar doctor/clínica/fecha
        $('#doctor_id, #clinica_id, #fecha_cita').on('change', verificarDisponibilidad);

        function verificarDisponibilidad() {
            const doctorId = $('#doctor_id').val();
            const clinicaId = $('#clinica_id').val();
            const fechaCita = $('#fecha_cita').val();

            if (doctorId && clinicaId && fechaCita) {
                $.ajax({
                    url: '{{ url("agenda/disponibilidad") }}',
                    type: 'GET',
                    data: {
                        doctor_id: doctorId,
                        clinica_id: clinicaId,
                        fecha: fechaCita
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
