<!-- Modal para ver detalles de la cita -->
<div class="modal fade" id="verCitaModal" tabindex="-1" role="dialog" aria-labelledby="verCitaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verCitaModalLabel">Detalles de la Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6 class="text-primary">Paciente:</h6>
                    <p id="ver-paciente"></p>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-primary">Doctor:</h6>
                        <p id="ver-doctor"></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary">Clínica:</h6>
                        <p id="ver-clinica"></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-primary">Fecha:</h6>
                        <p id="ver-fecha"></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary">Horario:</h6>
                        <p id="ver-horario"></p>
                    </div>
                </div>
                <div class="mb-3">
                    <h6 class="text-primary">Estado:</h6>
                    <p id="ver-estado"></p>
                </div>
                <div class="mb-3">
                    <h6 class="text-primary">Motivo / Observaciones:</h6>
                    <p id="ver-motivo"></p>
                </div>
                <div class="mb-3">
                    <h6 class="text-primary">Creada el:</h6>
                    <p id="ver-creacion"></p>
                </div>
                <div class="mb-3">
                    <h6 class="text-primary">Última actualización:</h6>
                    <p id="ver-actualizacion"></p>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col">
                        <button type="button" class="btn btn-primary btn-editar-cita w-100" id="btn-editar-cita">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-danger btn-eliminar-cita w-100" id="btn-eliminar-cita">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-secondary btn-imprimir-cita w-100" id="btn-imprimir-cita">
                            <i class="bi bi-printer"></i> Imprimir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cargar datos al abrir el modal de ver cita
        $(document).on('click', '.btn-ver-cita', function() {
            const citaId = $(this).data('id');

            // Cargar datos mediante AJAX
            $.ajax({
                url: '{{ url("show-cita") }}/' + citaId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const cita = data.cita;

                    // Llenar el modal con los datos
                    $('#ver-paciente').text(cita.paciente.nombre);
                    $('#ver-doctor').text('Dr. ' + cita.doctor.name);
                    $('#ver-clinica').text(cita.clinica.nombre);

                    // Formatear fecha en español
                    const fecha = new Date(cita.fecha_cita);
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    $('#ver-fecha').text(fecha.toLocaleDateString('es-ES', options));

                    $('#ver-horario').text(cita.hora_inicio.substring(0, 5) + ' - ' + cita.hora_fin.substring(0, 5));

                    // Mostrar estado con badge
                    let estadoHTML = '';
                    if (cita.estado === 'Pendiente') {
                        estadoHTML = '<span class="badge bg-warning">Pendiente</span>';
                    } else if (cita.estado === 'Confirmada') {
                        estadoHTML = '<span class="badge bg-success">Confirmada</span>';
                    } else if (cita.estado === 'Atendida') {
                        estadoHTML = '<span class="badge bg-info">Atendida</span>';
                    }
                    $('#ver-estado').html(estadoHTML);

                    $('#ver-motivo').text(cita.motivo);

                    // Formatear fechas de creación y actualización
                    const creacion = new Date(cita.created_at);
                    const actualizacion = new Date(cita.updated_at);
                    const formatoCompleto = {
                        year: 'numeric', month: 'long', day: 'numeric',
                        hour: '2-digit', minute: '2-digit'
                    };

                    $('#ver-creacion').text(creacion.toLocaleDateString('es-ES', formatoCompleto));
                    $('#ver-actualizacion').text(actualizacion.toLocaleDateString('es-ES', formatoCompleto));

                    // Configurar botones de acción
                    $('#btn-editar-cita').data('id', citaId);
                    $('#btn-eliminar-cita').data('id', citaId);
                    $('#btn-imprimir-cita').data('id', citaId);
                },
                error: function(xhr) {
                    toastr.error('Error al cargar los datos de la cita');
                }
            });
        });

        // Botón para editar desde el modal de ver
        $(document).on('click', '#btn-editar-cita', function() {
            const citaId = $(this).data('id');
            $('#verCitaModal').modal('hide');

            setTimeout(function() {
                $('.btn-editar-cita[data-id="' + citaId + '"]').trigger('click');
            }, 500);
        });

        // Botón para eliminar desde el modal de ver
        $(document).on('click', '#btn-eliminar-cita', function() {
            const citaId = $(this).data('id');

            if (confirm('¿Está seguro de que desea eliminar esta cita?')) {
                $.ajax({
                    url: '{{ url("agenda/citas") }}/' + citaId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#verCitaModal').modal('hide');
                            toastr.success(response.message);
                            setTimeout(() => window.location.reload(), 1500);
                        } else {
                            toastr.error('Error al eliminar la cita');
                        }
                    },
                    error: function() {
                        toastr.error('Error al procesar la solicitud');
                    }
                });
            }
        });

        // Botón para imprimir desde el modal de ver
        $(document).on('click', '#btn-imprimir-cita', function() {
            const citaId = $(this).data('id');
            window.open('{{ url("print-cita") }}?cita_id=' + citaId + '&pdftamaño=letter&pdfhorientacion=portrait&pdfarchivo=stream', '_blank');
        });
    });
</script>
