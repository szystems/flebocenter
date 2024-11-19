<!-- Modal -->
<div class="modal fade" id="editarSeguimientoModal{{ $seguimiento->id }}" tabindex="-1"
    aria-labelledby="editarSeguimientoModal{{ $seguimiento->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarSeguimientoModal{{ $seguimiento->id }}">
                    <i class="bi bi-pencil text-warning"></i> Editar Seguimiento
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <form action="{{ url('update-seguimiento/'.$seguimiento->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row gx-3">

                        <div class="col-md-3 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label for="fecha" class="form-label"><strong>Fecha</strong></label>
                                <input type="date" name="fecha" class="form-control" value="{{ $seguimiento->fecha }}" required/>
                                @if ($errors->has('fecha'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('fecha') }}</font>
                                            </strong>
                                    </span>
                                @endif
                                <input type="hidden" name="paciente_id" value="{{ $seguimiento->paciente_id }}">
                                <input type="hidden" name="doctor_id" value="{{ $seguimiento->doctor_id }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="receta"><strong>Doctor</strong></label>
                                <p>{{ $seguimiento->doctor->name }} ({{ $seguimiento->doctor->colegiado }})</p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="seguimiento"><strong>Seguimiento</strong></label>
                                {{-- <textarea name="descripcion" class="form-control" rows="6" placeholder="Descripción de la seguimiento...">{{ $seguimiento->descripcion }}</textarea> --}}
                                <textarea id="editseguimiento{{ $seguimiento->id }}" class="form-control border px-2 class" name="descripcion" rows="20">{!! html_entity_decode($seguimiento->descripcion) !!}</textarea>
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
        let editorInstance__{{ $seguimiento->id }};

        $('#editarSeguimientoModal{{ $seguimiento->id }}').on('shown.bs.modal', function() {
            if (editorInstance__{{ $seguimiento->id }}) {
                editorInstance__{{ $seguimiento->id }}.destroy();
            }

            ClassicEditor
                .create( document.querySelector( '#editseguimiento{{ $seguimiento->id }}' ) )
                .then(editor => {
                    editorInstance__{{ $seguimiento->id }} = editor;
                })
                .catch( error => {
                    console.error( error );
                } );
        });

        $('#editarSeguimientoModal{{ $seguimiento->id }}').on('hidden.bs.modal', function() {
            if (editorInstance__{{ $seguimiento->id }}) {
                editorInstance__{{ $seguimiento->id }}.destroy();
                editorInstance__{{ $seguimiento->id }} = null;
            }
        });
    </script>
