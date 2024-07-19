<div class="modal fade" id="deleteDetalleModal-{{ $detalle->id }}" tabindex="-1" aria-labelledby="deleteDetalleModal-{{ $detalle->id }}" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="deleteDetalleModal-{{ $detalle->id }}">
                    Eliminar Pago:
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro de eliminar este detalle de venta?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancelar
                </button>
                <a href="{{ url('delete-detalle-venta/'.$detalle->id) }}" type="button" class="btn btn-danger">
                    <i class="bi bi-trash"></i> Eliminar
                </a>
            </div>
        </div>
    </div>
</div>
