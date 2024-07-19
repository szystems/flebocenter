<!-- Modal -->
<div class="modal fade" id="addDetalleModal" tabindex="-1"
aria-labelledby="addDetalleModal" aria-hidden="true">

<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addDetalleModal">
                <i class="bi bi-plus text-success"></i> Agregar Detalle de Venta
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
        <form action="{{ url('insert-detalle-venta') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row gx-3">

                    <div class="col-md-6 mb-3">
                        <!-- Form Field Start -->
                        <div class="mb-3">
                            <label for="articulo_id" class="form-label">Artículo</label>
                            <select name="pidarticulo" id="pidarticulo" class="form-select" aria-label="Default select example" required>
                                <option value="">Seleccione articulo</option>
                                @foreach($articulos as $articulo)
                                    <option value="{{$articulo->id}}" {{ old('articulo_id') == $articulo->id ? ' selected' : '' }}> {{ $articulo->codigo }} - {{ $articulo->nombre }} - {{ $config->currency_simbol }}.{{number_format($articulo->precio_venta,2, '.', '')}} - Stock: {{ $articulo->stock }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('articulo_id'))
                                <span class="help-block opacity-7">
                                    <strong>
                                        <font color="red">{{ $errors->first('articulo_id') }}</font>
                                    </strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Cantidad</label>
                        <div class="input-group">
                            {{-- <span class="input-group-text">{{ $config->currency_simbol }}.</span> --}}
                            <input name="pcantidad" id="pcantidad" type="number" class="form-control" min="0" step="1" placeholder="0" value="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                        </div>
                        @if ($errors->has('pcantidad'))
                            <span class="help-block opacity-7">
                                <strong>
                                    <font color="red">{{ $errors->first('pcantidad') }}</font>
                                </strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Descuento</label>
                        <div class="input-group">
                            <span class="input-group-text">%</span>
                            <input name="pdescuento" id="pdescuento" type="number" class="form-control" placeholder="0"  value="0" required>
                        </div>
                        @if ($errors->has('pdescuento'))
                            <span class="help-block opacity-7">
                                <strong>
                                    <font color="red">{{ $errors->first('pdescuento') }}</font>
                                </strong>
                            </span>
                        @endif
                    </div>

                    <input type="hidden" name="venta_id" value="{{ $venta->id }}">

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


