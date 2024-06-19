<!-- Modal -->
<div class="modal fade" id="editarDocModal{{ $doc->id }}" tabindex="-1"
    aria-labelledby="editarDocModal{{ $doc->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarDocModal{{ $doc->id }}">
                    <i class="bi bi-pencil text-warning"></i> Editar Documento
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <form action="{{ url('update-documento/'.$doc->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row gx-3">

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input name="nombre" type="text" class="form-control" placeholder="Nombre..." value="{{$doc->nombre }}" required/>
                                @if ($errors->has('nombre'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('nombre') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="3" placeholder="Descripción...">{{ $doc->descripcion }}</textarea>
                                @if ($errors->has('descripcion'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('descripcion') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">

                        <div class="col-md-4 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">Archivo</label>
                                <p>{{ $doc->nombre }}</p>
                                <input type="file" name="archivo" class="form-control border" value="{{ old('archivo') }}">
                                @if ($errors->has('archivo'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('archivo') }}</font>
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

