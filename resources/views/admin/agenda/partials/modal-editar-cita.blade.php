<!-- Modal de edición de cita -->
<div class="modal fade" id="editarCitaModal" tabindex="-1" role="dialog" aria-labelledby="editarCitaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarCitaModalLabel">Editar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarCita">
                @csrf
                @method('PUT')
                <input type="hidden" id="cita_id" name="cita_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="paciente_id" class="form-label">Paciente</label>
                                <select class="form-control select2-edit" id="paciente_id" name="paciente_id" required>
                                    <option value="">Seleccione un paciente</option>
                                    @foreach($filtroPacientes as $paciente)
                                        <option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->dpi ? '- DPI: '.$paciente->dpi : '' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="doctor_id" class="form-label">Doctor</label>
                                <select class="form-control select2-edit" id="doctor_id" name="doctor_id" required>
                                    <option value="">Seleccione un doctor</option>
                                    @foreach($filtroDoctores as $doctor)
                                        <option value="{{ $doctor->id }}">Dr. {{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="clinica_id" class="form-label">Clínica</label>
                                <select class="form-control select2-edit" id="clinica_id" name="clinica_id" required>
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
                                       value="{{ $fecha }}" required>
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

                    <div id="horarios-ocupados-editar" class="alert alert-info d-none">
                        <h6>Horarios ocupados para este doctor en esta fecha:</h6>
                        <div id="lista-horarios-ocupados-editar"></div>
                    </div>

                    <div id="error-traslape-editar" class="alert alert-danger d-none">
                        El horario seleccionado se traslapa con otra cita existente.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Cita</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cargar datos específicos al abrir el modal de edición
        $('#editarCitaModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const citaId = button.data('id');

            // Cargar datos mediante AJAX para llenar correctamente los selects
            $.ajax({
                url: '{{ url("show-cita") }}/' + citaId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const cita = data.cita;

                    // Llenar los select2 con los valores correctos
                    $('#editarCitaModal #paciente_id').val(cita.paciente_id).trigger('change');
                    $('#editarCitaModal #doctor_id').val(cita.doctor_id).trigger('change');
                    $('#editarCitaModal #clinica_id').val(cita.clinica_id).trigger('change');

                    // Actualizar el resto del formulario
                    $('#editarCitaModal #fecha_cita').val(cita.fecha_cita);
                    $('#editarCitaModal #hora_inicio').val(cita.hora_inicio.substring(0, 5));
                    $('#editarCitaModal #hora_fin').val(cita.hora_fin.substring(0, 5));
                    $('#editarCitaModal #estado').val(cita.estado);
                    $('#editarCitaModal #motivo').val(cita.motivo);

                    // Verificar disponibilidad al cargar
                    verificarDisponibilidad();
                },
                error: function(xhr) {
                    toastr.error('Error al cargar los datos de la cita');
                }
            });
        });

        // Manejar cambio de doctor y fechas para verificar disponibilidad
        $('#editarCitaModal #doctor_id, #editarCitaModal #clinica_id, #editarCitaModal #fecha_cita').on('change', verificarDisponibilidad);

        function verificarDisponibilidad() {
            const doctorId = $('#editarCitaModal #doctor_id').val();
            const clinicaId = $('#editarCitaModal #clinica_id').val();
            const fechaCita = $('#editarCitaModal #fecha_cita').val();
            const citaId = $('#editarCitaModal #cita_id').val();

            if (doctorId && clinicaId && fechaCita) {
                $.ajax({
                    url: '{{ url("agenda/disponibilidad") }}',
                    type: 'GET',
                    data: {
                        doctor_id: doctorId,
                        clinica_id: clinicaId,
                        fecha: fechaCita,
                        cita_id: citaId
                    },
                    success: function(response) {
                        // Mostrar horas ocupadas en la interfaz
                        const citasOcupadas = response.citas;

                        if(citasOcupadas.length > 0) {
                            $('#horarios-ocupados-editar').removeClass('d-none');
                            let horariosHTML = '<ul>';
                            citasOcupadas.forEach(function(cita) {
                                horariosHTML += `<li>${cita.hora_inicio.substring(0, 5)} - ${cita.hora_fin.substring(0, 5)}</li>`;
                            });
                            horariosHTML += '</ul>';
                            $('#lista-horarios-ocupados-editar').html(horariosHTML);
                        } else {
                            $('#horarios-ocupados-editar').addClass('d-none');
                        }
                    },
                    error: function(error) {
                        console.error('Error al verificar disponibilidad:', error);
                    }
                });
            }
        }

        // Envío del formulario por AJAX
        $('#formEditarCita').submit(function(e) {
            e.preventDefault();

            const form = $(this);
            const citaId = $('#editarCitaModal #cita_id').val();

            $.ajax({
                url: '{{ url("agenda/citas") }}/' + citaId,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    paciente_id: $('#editarCitaModal #paciente_id').val(),
                    doctor_id: $('#editarCitaModal #doctor_id').val(),
                    clinica_id: $('#editarCitaModal #clinica_id').val(),
                    fecha_cita: $('#editarCitaModal #fecha_cita').val(),
                    hora_inicio: $('#editarCitaModal #hora_inicio').val(),
                    hora_fin: $('#editarCitaModal #hora_fin').val(),
                    motivo: $('#editarCitaModal #motivo').val(),
                    estado: $('#editarCitaModal #estado').val()
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#error-traslape-editar').addClass('d-none');
                },
                success: function(response) {
                    if (response.success) {
                        // Cerrar modal y refrescar página
                        $('#editarCitaModal').modal('hide');
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
                            $('#error-traslape-editar').removeClass('d-none');
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
    });
</script>
