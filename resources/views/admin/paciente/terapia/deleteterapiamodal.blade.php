<div class="modal fade" id="deleteTerapiaModal-{{ $terapia->id }}" tabindex="-1" aria-labelledby="deleteTerapiaModal-{{ $terapia->id }}" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="{{ url('delete-terapia/'.$terapia->id) }}" method="GET">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title h4" id="deleteTerapiaModal-{{ $terapia->id }}">
                        Eliminar Terapia:
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Si elimina esta terapia de drenaje linfático se eliminarán todas las sesiones creadas dentro de ella, ¿Está seguro de eliminar esta terapia?
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
