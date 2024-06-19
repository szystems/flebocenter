<!-- Modal -->
<div class="modal fade" id="editarDerModal{{ $sesion->id }}" tabindex="-1"
    aria-labelledby="editarDerModal{{ $sesion->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarDerModal{{ $sesion->id }}">
                    <i class="bi bi-pencil text-warning"></i> Editar Sesion Miembro Inferior Derecho
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <form action="{{ url('update-sesion-derecha/'.$sesion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
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
                                <input name="antes1" type="text" class="form-control" placeholder="" value="{{ $sesion->antes1 }}" />
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <input name="antes2" type="text" class="form-control" placeholder="" value="{{ $sesion->antes2 }}" />
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <input name="antes3" type="text" class="form-control" placeholder="" value="{{ $sesion->antes3 }}" />
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <input name="antes4" type="text" class="form-control" placeholder="" value="{{ $sesion->antes4 }}" />
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
                                <input name="despues1" type="text" class="form-control" placeholder="" value="{{ $sesion->despues1 }}" />
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <input name="despues2" type="text" class="form-control" placeholder="" value="{{ $sesion->despues2 }}" />
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <input name="despues3" type="text" class="form-control" placeholder="" value="{{ $sesion->despues3 }}" />
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <input name="despues4" type="text" class="form-control" placeholder="" value="{{ $sesion->despues4 }}" />
                            </div>
                        </div>

                        <input type="hidden" name="terapia_id" value="{{ $terapia->id }}">



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

