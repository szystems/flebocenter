<!-- Modal -->
<div class="modal fade" id="addDocModal" tabindex="-1"
aria-labelledby="addDocModal" aria-hidden="true">

<div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header sticky-top bg-white">
            <h5 class="modal-title" id="addDocModal">
                <i class="bi bi-plus text-success"></i> Agregar Documento
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
        <form action="{{ url('insert-documento') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="row gx-3">

                    <div class="col-md-12 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input name="nombre" type="text" class="form-control" placeholder="Nombre..." value="{{ old('nombre') }}" required/>
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
                            <textarea name="descripcion" class="form-control" rows="3" placeholder="Descripción...">{{ old('descripcion') }}</textarea>
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
                            <input type="file" name="archivo" class="form-control border" value="{{ old('archivo') }}" required>
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


