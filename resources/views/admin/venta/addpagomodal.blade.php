<!-- Modal -->
<div class="modal fade" id="addPagoModal" tabindex="-1"
aria-labelledby="addPagoModal" aria-hidden="true">

<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addPagoModal">
                <i class="bi bi-plus text-success"></i> Agregar Pago
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
        <form action="{{ url('insert-pago-venta') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row gx-3">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cantidad</label>
                        <div class="input-group">
                            <span class="input-group-text">Q.</span>
                            <input name="cantidad" type="number" step="0.01" class="form-control" id="cantidad" placeholder="0.00"  value="{{ number_format($saldo,2, '.', '') }}" required>
                        </div>
                        @if ($errors->has('cantidad'))
                            <span class="help-block opacity-7">
                                    <strong>
                                        <font color="red">{{ $errors->first('cantidad') }}</font>
                                    </strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-8 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label for="tipo_pago" class="form-label">Tipo Pago</label>
                            <select name="tipo_pago" class="form-select" aria-label="Default select example" required>
                                <option value="">Seleccione tipo de pago...</option>
                                <option value="Efectivo" {{ old('tipo_pago') == "Efectivo" ? ' selected' : '' }}>Efectivo</option>
                                <option value="Cheque" {{ old('tipo_pago') == "Cheque" ? ' selected' : '' }}>Cheque</option>
                                <option value="Deposito" {{ old('tipo_pago') == "Deposito" ? ' selected' : '' }}>Deposito</option>
                                <option value="Transferencia" {{ old('tipo_pago') == "Transferencia" ? ' selected' : '' }}>Transferencia</option>
                                <option value="Tarjeta C/D" {{ old('tipo_pago') == "Tarjeta C/D" ? ' selected' : '' }}>Tarjeta C/D</option>
                                <option value="Moneda Digital" {{ old('tipo_pago') == "Moneda Digital" ? ' selected' : '' }}>Moneda Digital</option>
                                <option value="Especie" {{ old('tipo_pago') == "Especie" ? ' selected' : '' }}>Especie</option>
                                <option value="Exoneracion" {{ old('tipo_pago') == "Exoneracion" ? ' selected' : '' }}>Exoneracion</option>
                                <option value="Otros" {{ old('tipo_pago') == "Otros" ? ' selected' : '' }}>Otros</option>
                            </select>
                            @if ($errors->has('forma_pago'))
                                <span class="help-block opacity-7">
                                        <strong>
                                            <font color="red">{{ $errors->first('forma_pago') }}</font>
                                        </strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <input type="hidden" name="venta_id" value="{{ $venta->id }}">

                    <div class="col-md-12 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label class="form-label">Imagen</label>
                            <input type="file" name="imagen" class="form-control border" value="{{ old('imagen') }}">
                            @if ($errors->has('imagen'))
                                <span class="help-block opacity-7">
                                        <strong>
                                            <font color="red">{{ $errors->first('imagen') }}</font>
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


