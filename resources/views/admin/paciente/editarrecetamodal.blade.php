<!-- Modal -->
<div class="modal fade" id="editarRecetaModal{{ $receta->id }}" tabindex="-1"
aria-labelledby="editarRecetaModal{{ $receta->id }}" aria-hidden="true">
<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editarRecetaModal{{ $receta->id }}">
                <i class="bi bi-pencil text-warning"></i> Editar Receta
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>


        <form action="{{ url('update-receta/'.$receta->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row gx-3">

                    <div class="col-md-12 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label class="receta"><strong>Fecha</strong></label>
                            <p>{{ $fechaReceta }}</p>
                            <input type="hidden" name="fecha" value="{{ $receta->fecha }}">
                            <input type="hidden" name="paciente_id" value="{{ $receta->paciente_id }}">
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label class="receta"><strong>Receta</strong></label>
                            <textarea name="descripcion" class="form-control" rows="6" placeholder="Descripción de la receta...">{{ $receta->descripcion }}</textarea>
                            @if ($errors->has('descripcion'))
                                <span class="help-block opacity-7">
                                        <strong>
                                            <font color="red">{{ $errors->first('descripcion') }}</font>
                                        </strong>
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-check2-square"></i> Grabar
                </button>
            </div>
        </form>
    </div>
</div>
</div>
