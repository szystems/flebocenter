<!-- Modal -->
<div class="modal fade" id="addRecetaModal" tabindex="-1"
aria-labelledby="addRecetaModal" aria-hidden="true">

<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addRecetaModal">
                <i class="bi bi-pencil text-warning"></i> Crear Receta
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        @if (count($errors)>0)
            <div class="alert alert-danger text-white" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>

        @endif
        <form action="{{ url('insert-receta') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row gx-3">

                    <div class="col-md-12 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label class="receta"><strong>Fecha</strong></label>
                            <?php
                                $hoy = now();
                                $hoyshow = date("d/m/Y", strtotime($hoy));
                            ?>
                            <p><?php echo $hoyshow; ?></p>
                            <input type="hidden" name="fecha" value="<?php echo $hoy; ?>">
                            <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label class="receta"><strong>Receta</strong></label>
                            {{-- <textarea name="descripcion" class="form-control" rows="6" placeholder="Descripción de la receta...">{{ $receta->descripcion }}</textarea> --}}
                            <textarea id="addreceta" class="form-control border px-2 class" name="descripcion" rows="20">{{ old('descripcion') }}</textarea>
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

<script>
    let editorInstance;

    $('#addRecetaModal').on('shown.bs.modal', function() {
        if (editorInstance) {
            editorInstance.destroy();
        }

        ClassicEditor
            .create( document.querySelector( '#addreceta' ) )
            .then(editor => {
                editorInstance = editor;
            })
            .catch( error => {
                console.error( error );
            } );
    });

    $('#addRecetaModal').on('hidden.bs.modal', function() {
        if (editorInstance) {
            editorInstance.destroy();
            editorInstance = null;
        }
    });
</script>

