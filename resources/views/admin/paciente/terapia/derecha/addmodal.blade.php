<!-- Modal -->
<div class="modal fade" id="addDerModal" tabindex="-1"
aria-labelledby="addDerModal" aria-hidden="true">

<div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header sticky-top bg-white">
            <h5 class="modal-title" id="addDerModal">
                <i class="bi bi-plus text-success"></i> Agregar Sesion Miembro Inferior Derecho
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
        <form action="{{ url('insert-sesion-derecha') }}" method="POST">
            @csrf
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="row gx-3">

                    <div class="col-md-12 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label for="antes" class="form-label">Antes</label>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <input name="antes1" type="text" class="form-control" placeholder="" value="{{ old('antes1') }}" />
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <input name="antes2" type="text" class="form-control" placeholder="" value="{{ old('antes2') }}" />
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <input name="antes3" type="text" class="form-control" placeholder="" value="{{ old('antes3') }}" />
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <input name="antes4" type="text" class="form-control" placeholder="" value="{{ old('antes4') }}" />
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label for="despues" class="form-label">Despues</label>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <input name="despues1" type="text" class="form-control" placeholder="" value="{{ old('despues1') }}" />
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <input name="despues2" type="text" class="form-control" placeholder="" value="{{ old('despues2') }}" />
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <input name="despues3" type="text" class="form-control" placeholder="" value="{{ old('despues3') }}" />
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <input name="despues4" type="text" class="form-control" placeholder="" value="{{ old('despues4') }}" />
                        </div>
                    </div>

                    <input type="hidden" name="terapia_id" value="{{ $terapia->id }}">

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


