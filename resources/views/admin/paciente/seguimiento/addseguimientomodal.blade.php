<!-- Modal -->
<div class="modal fade" id="addSeguimientoModal" tabindex="-1"
aria-labelledby="addSeguimientoModal" aria-hidden="true">

<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addSeguimientoModal">
                <i class="bi bi-pencil text-warning"></i> Crear Seguimiento
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
        <form action="{{ url('insert-seguimiento') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row gx-3">

                    <div class="col-md-3 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label for="fecha" class="form-label"><strong>Fecha</strong></label>
                            <input type="date" name="fecha" class="form-control" value="{{ old('fecha') ?? now()->format('Y-m-d') }}" required/>
                            @if ($errors->has('fecha'))
                                <span class="help-block opacity-7">
                                        <strong>
                                            <font color="red">{{ $errors->first('fecha') }}</font>
                                        </strong>
                                </span>
                            @endif
                            <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                            <input type="hidden" name="doctor_id" value="{{ Auth::User()->id }}">
                        </div>
                    </div>

                    <div class="col-md-8 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label class="seguimiento"><strong>Doctor</strong></label>
                            <p>{{ Auth::User()->name }} ({{ Auth::User()->colegiado }})</p>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label class="seguimiento"><strong>Seguimiento</strong></label>
                            {{-- <textarea name="descripcion" class="form-control" rows="6" placeholder="Descripción de la seguimiento...">{{ $seguimiento->descripcion }}</textarea> --}}
                            <textarea id="addseguimiento" class="form-control border px-2 class" name="descripcion" rows="20">{{ old('descripcion') }}</textarea>
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

    $('#addSeguimientoModal').on('shown.bs.modal', function() {
        if (editorInstance) {
            editorInstance.destroy();
        }

        ClassicEditor
            .create( document.querySelector( '#addseguimiento' ) )
            .then(editor => {
                editorInstance = editor;
            })
            .catch( error => {
                console.error( error );
            } );
    });

    $('#addSeguimientoModal').on('hidden.bs.modal', function() {
        if (editorInstance) {
            editorInstance.destroy();
            editorInstance = null;
        }
    });
</script>

