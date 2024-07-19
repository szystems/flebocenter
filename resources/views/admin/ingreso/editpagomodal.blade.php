<!-- Modal -->
<div class="modal fade" id="editarPagoModal{{ $pago->id }}" tabindex="-1"
    aria-labelledby="editarPagoModal{{ $pago->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarPagoModal{{ $pago->id }}">
                    <i class="bi bi-pencil text-warning"></i> Editar Pago
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <form action="{{ url('update-pago/'.$pago->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row gx-3">

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Cantidad</label>
                            <div class="input-group">
                                <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                <input name="cantidad" type="number" step="0.01" class="form-control" id="monto_q" placeholder="0.00"  value="{{ $pago->cantidad }}" required>
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
                                        <option value="Efectivo" {{ $pago->tipo_pago == 'Efectivo' ? ' selected' : '' }}>Efectivo</option>
                                        <option value="Cheque" {{ $pago->tipo_pago == 'Cheque' ? ' selected' : '' }}>Cheque</option>
                                        <option value="Deposito" {{ $pago->tipo_pago == 'Deposito' ? ' selected' : '' }}>Deposito</option>
                                        <option value="Transferencia"{{ $pago->tipo_pago == 'Transferencia' ? ' selected' : '' }}>Transferencia</option>
                                        <option value="Tarjeta C/D" {{ $pago->tipo_pago == 'Tarjeta C/D' ? ' selected' : '' }}>Tarjeta C/D</option>
                                        <option value="Moneda Digital" {{ $pago->tipo_pago == 'Moneda Digital' ? ' selected' : '' }}>Moneda Digital</option>
                                        <option value="Especie" {{ $pago->tipo_pago == 'Especie' ? ' selected' : '' }}>Especie</option>
                                        <option value="Exoneracion" {{ $pago->tipo_pago == 'Exoneracion' ? ' selected' : '' }}>Exoneracion</option>
                                        <option value="Otros" {{ $pago->tipo_pago == 'Otros' ? ' selected' : '' }}>Otros</option>
                                </select>
                                @if ($errors->has('tipo_pago'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('tipo_pago') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input type="hidden" name="ingreso_id" value="{{ $pago->ingreso_id }}">

                        @if ($pago->imagen)
                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">Imagen</label>
                                <a href="{{ asset('assets/imgs/pagos/'.$pago->imagen) }}" target="_blank" rel="Imagen pago"><img src="{{ asset('assets/imgs/pagos/'.$pago->imagen) }}" class="img-thumbnail" style="height: 100px;" alt="Imagen pago" /></a>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-6 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label class="form-label">Cambiar</label>
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

