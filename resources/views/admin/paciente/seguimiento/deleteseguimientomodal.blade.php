<div class="modal fade" id="deleteseguimientoModal-{{ $seguimiento->id }}" tabindex="-1" aria-labelledby="deleteseguimientoModal-{{ $seguimiento->id }}" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="{{ url('delete-seguimiento/'.$seguimiento->id) }}" method="GET">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title h4" id="deleteseguimientoModal-{{ $seguimiento->id }}">
                        Eliminar Seguimiento:
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar esta seguimiento?
                    <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
