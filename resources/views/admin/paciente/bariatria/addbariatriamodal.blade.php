<!-- Modal -->
<div class="modal fade" id="addBariatriaModal" tabindex="-1"
aria-labelledby="addBariatriaModal" aria-hidden="true">

<div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header sticky-top bg-white">
            <h5 class="modal-title" id="addBariatriaModal">
                <i class="bi bi-plus-circle text-success"></i> Agregar Evaluación Bariátrica
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
        
        <form action="{{ url('insert-bariatria') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="row gx-3">
                    <div class="col-md-4 mb-3">
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
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="mb-3">
                            <label for="peso" class="form-label"><strong>Peso (kg)</strong></label>
                            <input type="number" step="0.01" name="peso" class="form-control" value="{{ old('peso') }}" />
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="mb-3">
                            <label for="talla" class="form-label"><strong>Talla (cm)</strong></label>
                            <input type="number" step="0.01" name="talla" class="form-control" value="{{ old('talla') }}" />
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="mb-3">
                            <label for="cci" class="form-label"><strong>Circunferencia de Cintura (cm)</strong></label>
                            <input type="number" step="0.01" name="cci" class="form-control" value="{{ old('cci') }}" />
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="mb-3">
                            <label for="cca" class="form-label"><strong>Circunferencia de Cadera (cm)</strong></label>
                            <input type="number" step="0.01" name="cca" class="form-control" value="{{ old('cca') }}" />
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="mb-3">
                            <label for="ccu" class="form-label"><strong>Circunferencia de Cuello (cm)</strong></label>
                            <input type="number" step="0.01" name="ccu" class="form-control" value="{{ old('ccu') }}" />
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="mb-3">
                            <label for="imc" class="form-label"><strong>IMC</strong></label>
                            <input type="number" step="0.01" name="imc" class="form-control" value="{{ old('imc') }}" />
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="mb-3">
                            <label for="icc" class="form-label"><strong>ICC (Índice Cintura/Cadera)</strong></label>
                            <input type="number" step="0.01" name="icc" class="form-control" value="{{ old('icc') }}" />
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="mb-3">
                            <label for="ict" class="form-label"><strong>ICT (Índice Cintura/Talla)</strong></label>
                            <input type="number" step="0.01" name="ict" class="form-control" value="{{ old('ict') }}" />
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="mb-3">
                            <label for="pdf_path" class="form-label"><strong>Subir PDF</strong></label>
                            <input type="file" name="pdf_path" class="form-control" accept=".pdf" />
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="mb-3">
                            <label for="kilocalorias" class="form-label"><strong>Kilocalorias</strong></label>
                            <input type="number" name="kilocalorias" class="form-control" value="{{ old('kilocalorias') }}" />
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="mb-3">
                            <label for="diagnostico" class="form-label"><strong>Diagnóstico</strong></label>
                            <textarea id="adddiagnostico" class="form-control border px-2 class" name="diagnostico" rows="5">{{ old('diagnostico') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="mb-3">
                            <label for="medicamentos" class="form-label"><strong>Medicamentos</strong></label>
                            <textarea id="addmedicamentos" class="form-control border px-2 class" name="medicamentos" rows="3">{{ old('medicamentos') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="mb-3">
                            <label for="suplementacion" class="form-label"><strong>Suplementación</strong></label>
                            <textarea id="addsuplementacion" class="form-control border px-2 class" name="suplementacion" rows="3">{{ old('suplementacion') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="mb-3">
                            <label for="ejercicios" class="form-label"><strong>Ejercicios Recomendados</strong></label>
                            <textarea id="addejercicios" class="form-control border px-2 class" name="ejercicios" rows="3">{{ old('ejercicios') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="mb-3">
                            <label for="comentarios" class="form-label"><strong>Comentarios Adicionales</strong></label>
                            <textarea id="addcomentarios" class="form-control border px-2 class" name="comentarios" rows="3">{{ old('comentarios') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer sticky-bottom bg-white">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check2-square"></i> Guardar
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
    let editorDiagnostico, editorMedicamentos, editorSuplementacion, editorEjercicios, editorComentarios;

    $('#addBariatriaModal').on('shown.bs.modal', function() {
        // Inicializar editores CKEditor
        ClassicEditor
            .create(document.querySelector('#adddiagnostico'))
            .then(editor => { editorDiagnostico = editor; })
            .catch(error => { console.error(error); });

        ClassicEditor
            .create(document.querySelector('#addmedicamentos'))
            .then(editor => { editorMedicamentos = editor; })
            .catch(error => { console.error(error); });

        ClassicEditor
            .create(document.querySelector('#addsuplementacion'))
            .then(editor => { editorSuplementacion = editor; })
            .catch(error => { console.error(error); });

        ClassicEditor
            .create(document.querySelector('#addejercicios'))
            .then(editor => { editorEjercicios = editor; })
            .catch(error => { console.error(error); });

        ClassicEditor
            .create(document.querySelector('#addcomentarios'))
            .then(editor => { editorComentarios = editor; })
            .catch(error => { console.error(error); });
    });

    $('#addBariatriaModal').on('hidden.bs.modal', function() {
        // Destruir editores CKEditor
        if (editorDiagnostico) { editorDiagnostico.destroy(); editorDiagnostico = null; }
        if (editorMedicamentos) { editorMedicamentos.destroy(); editorMedicamentos = null; }
        if (editorSuplementacion) { editorSuplementacion.destroy(); editorSuplementacion = null; }
        if (editorEjercicios) { editorEjercicios.destroy(); editorEjercicios = null; }
        if (editorComentarios) { editorComentarios.destroy(); editorComentarios = null; }
    });
</script>
