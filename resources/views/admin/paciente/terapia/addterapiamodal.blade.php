<!-- Modal -->
<div class="modal fade" id="addTerapiaModal" tabindex="-1"
aria-labelledby="addTerapiaModal" aria-hidden="true">

<div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header sticky-top bg-white">
            <h5 class="modal-title" id="addTerapiaModal">
                <i class="bi bi-plus text-success"></i> Agregar Terapia
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
        <form action="{{ url('insert-terapia') }}" method="POST">
            @csrf
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="row gx-3">

                    <div class="col-md-12 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Elastocompresión</label>
                            <input name="talla_media" type="text" class="form-control" placeholder="" value="{{ old('talla_media') }}" />
                            @if ($errors->has('talla_media'))
                                <span class="help-block opacity-7">
                                        <strong>
                                            <font color="red">{{ $errors->first('talla_media') }}</font>
                                        </strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label class="form-label">Diagnostico</label>
                            <textarea name="diagnostico" id="diagnostico" class="form-control" rows="3" placeholder="Diagnostico...">{{ old('diagnostico') }}</textarea>
                            {{-- <script>
                                ClassicEditor
                                  .create(document.querySelector('#diagnostico'), {
                                        ckfinder: {
                                            uploadUrl: "{{ url('upload_imagen_terapia') }}" + "?_token=" + "{{ csrf_token() }}"
                                        }
                                    })
                                  .catch(error => {
                                        console.error(error);
                                    });
                            </script> --}}
                            @if ($errors->has('diagnostico'))
                                <span class="help-block opacity-7">
                                        <strong>
                                            <font color="red">{{ $errors->first('diagnostico') }}</font>
                                        </strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones" id="observaciones" class="form-control" rows="3" placeholder="Observaciones...">{{ old('observaciones') }}</textarea>
                            {{-- <script>
                                ClassicEditor
                                  .create(document.querySelector('#observaciones'), {
                                        ckfinder: {
                                            uploadUrl: "{{ url('upload_imagen_terapia') }}" + "?_token=" + "{{ csrf_token() }}"
                                        }
                                    })
                                  .catch(error => {
                                        console.error(error);
                                    });
                            </script> --}}
                            @if ($errors->has('observaciones'))
                                <span class="help-block opacity-7">
                                        <strong>
                                            <font color="red">{{ $errors->first('observaciones') }}</font>
                                        </strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">

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


