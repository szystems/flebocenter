<!-- Modal -->
<div class="modal fade" id="editarRecetaModal{{ $receta->id }}" tabindex="-1"
    aria-labelledby="editarRecetaModal{{ $receta->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header sticky-top bg-white">
                <h5 class="modal-title" id="editarRecetaModal{{ $receta->id }}">
                    <i class="bi bi-pencil text-warning"></i> Editar Receta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ url('update-receta/'.$receta->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row gx-3">

                        <div class="col-md-3 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label for="fecha" class="form-label"><strong>Fecha</strong></label>
                                <input type="date" name="fecha" class="form-control" value="{{ $receta->fecha }}" required/>
                                @if ($errors->has('fecha'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('fecha') }}</font>
                                            </strong>
                                    </span>
                                @endif
                                <input type="hidden" name="paciente_id" value="{{ $receta->paciente_id }}">
                                <input type="hidden" name="doctor_id" value="{{ $receta->doctor_id }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="receta"><strong>Doctor</strong></label>
                                <p>{{ $receta->doctor->name }} ({{ $receta->doctor->colegiado }})</p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="receta"><strong>Receta</strong></label>
                                {{-- <textarea name="descripcion" class="form-control" rows="6" placeholder="Descripción de la receta...">{{ $receta->descripcion }}</textarea> --}}
                                <textarea id="editreceta{{ $receta->id }}" class="form-control border px-2 class" name="descripcion" rows="20">{!! html_entity_decode($receta->descripcion) !!}</textarea>
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
                <div class="modal-footer sticky-bottom bg-white">
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

<style>
    .modal-dialog-scrollable .modal-content {
        max-height: 85vh;
        overflow-y: hidden;
    }

    .modal-body {
        overflow-y: auto;
        padding-right: 15px;
    }

    .sticky-top {
        position: sticky;
        top: 0;
        z-index: 1020;
    }

    .sticky-bottom {
        position: sticky;
        bottom: 0;
        z-index: 1020;
    }
</style>

<script>
    let editorInstance__{{ $receta->id }};

    $('#editarRecetaModal{{ $receta->id }}').on('shown.bs.modal', function() {
        if (editorInstance__{{ $receta->id }}) {
            editorInstance__{{ $receta->id }}.destroy();
        }

        ClassicEditor
            .create( document.querySelector( '#editreceta{{ $receta->id }}' ) )
            .then(editor => {
                editorInstance__{{ $receta->id }} = editor;
            })
            .catch( error => {
                console.error( error );
            } );
    });

    $('#editarRecetaModal{{ $receta->id }}').on('hidden.bs.modal', function() {
        if (editorInstance__{{ $receta->id }}) {
            editorInstance__{{ $receta->id }}.destroy();
            editorInstance__{{ $receta->id }} = null;
        }
    });
</script>
