<!-- Modal -->
<div class="modal fade" id="printBariatriaModal{{ $bariatria->id }}" tabindex="-1" aria-labelledby="printBariatriaModal{{ $bariatria->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printBariatriaModal{{ $bariatria->id }}Title">
                    <i class="bi bi-printer text-info"></i> Imprimir Evaluación Bariátrica
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('print-bariatria') }}" method="GET" target="_blank">
                <div class="modal-body">
                    <div class="row gx-3 p-3">
                        <div class="col-md-6 mb-3">
                            <div class="mb-3">
                                <label for="pdftamaño" class="form-label">Tamaño</label>
                                <select name="pdftamaño" class="form-select" aria-label="Default select example">
                                    <option value="Letter"{{ request('pdftamaño') == 'Letter' ? ' selected' : '' }}>Carta</option>
                                    <option value="A4"{{ request('pdftamaño') == 'A4' ? ' selected' : '' }}>A4</option>
                                    <option value="Legal"{{ request('pdftamaño') == 'Legal' ? ' selected' : '' }}>Legal</option>
                                    <option value="Media Carta"{{ request('pdftamaño') == 'Media Carta' ? ' selected' : '' }}>Media Carta</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="mb-3">
                                <label for="pdfhorientacion" class="form-label">Orientación</label>
                                <select name="pdfhorientacion" class="form-select" aria-label="Default select example">
                                    <option value="portrait"{{ request('pdfhorientacion') == 'portrait' ? ' selected' : '' }}>Vertical</option>
                                    <option value="landscape"{{ request('pdfhorientacion') == 'landscape' ? ' selected' : '' }}>Horizontal</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="mb-3">
                                <label for="pdfarchivo" class="form-label">Tipo de Archivo</label>
                                <select name="pdfarchivo" class="form-select" aria-label="Default select example">
                                    <option value="download"{{ request('pdfarchivo') == 'download' ? ' selected' : '' }}>Descargar PDF</option>
                                    <option value="stream"{{ request('pdfarchivo') == 'stream' ? ' selected' : '' }}>Ver en navegador</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="bariatria_id" value="{{ $bariatria->id }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-info">
                        <i class="bi bi-printer"></i> Imprimir
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
