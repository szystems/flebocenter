<!-- Modal -->
<div class="modal fade" id="editarIngresoModal{{ $ingreso->id }}" tabindex="-1"
    aria-labelledby="editarIngresoModal{{ $ingreso->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarIngresoModal{{ $ingreso->id }}">
                    <i class="bi bi-pencil text-warning"></i> Editar Ingreso
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <form action="{{ url('update-ingreso/'.$ingreso->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row gx-3">

                        <div class="col-md-12 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Ingrese los datos del ingreso:</label>
                            </div>
                        </div>

                        @php
                            $fecha = date("d-m-Y", strtotime($ingreso->fecha));
                        @endphp

                        <div class="col-md-3 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-2">
                                <label for="fecha_cita" class="form-label">Fecha</label>
                                <div class="input-group">
                                    <input type="text" name="fecha" class="form-control datepicker text-center" id="fecha" value=""/>
                                    <span class="input-group-text">
                                        <i class="bi bi-calendar4"></i>
                                    </span>
                                </div>
                                <script>
                                    var date = new Date();
                                    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

                                    var optSimple = {
                                        language: "es",
                                        format: "dd-mm-yyyy",
                                        autoclose: true,
                                        todayHighlight: true,
                                        todayBtn: "linked",
                                        orientation: "bottom auto",
                                        startDate: "01-01-1900",


                                    };
                                    $( '#fecha' ).datepicker( optSimple );
                                    $( '#fecha').datepicker( 'setDate', '{{ $fecha }}' );
                                </script>
                                @if ($errors->has('fecha'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('fecha') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-9 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label for="proveedor_id" class="form-label">Proveedor</label>
                                <select name="proveedor_id" class="form-select" aria-label="Default select example" required>
                                    <option value="">Seleccione proveedor</option>
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}"{{ $ingreso->proveedor_id == $proveedor->id ? ' selected' : '' }}>{{ $proveedor->nombre }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('proveedor_id'))
                                    <span class="help-block opacity-7">
                                        <strong>
                                            <font color="red">{{ $errors->first('proveedor_id') }}</font>
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label for="tipo_comprobante" class="form-label">Tipo Comprobante</label>
                                <select name="tipo_comprobante" class="form-select" aria-label="Default select example">
                                    <option value=""{{ $ingreso->tipo_comprobante == '' ? ' selected' : '' }}></option>
                                    <option value="Factura"{{ $ingreso->tipo_comprobante == 'Factura' ? ' selected' : '' }}>Factura</option>
                                    <option value="Recibo"{{ $ingreso->tipo_comprobante == 'Recibo' ? ' selected' : '' }}>Recibo</option>
                                    <option value="Boleta"{{ $ingreso->tipo_comprobante == 'Boleta' ? ' selected' : '' }}>Boleta</option>
                                    <option value="Ticket"{{ $ingreso->tipo_comprobante == 'Ticket' ? ' selected' : '' }}>Ticket</option>
                                </select>
                                @if ($errors->has('tipo_comprobante'))
                                    <span class="help-block opacity-7">
                                        <strong>
                                            <font color="red">{{ $errors->first('tipo_comprobante') }}</font>
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label for="serie_comprobante" class="form-label">Serie Comprobante</label>
                                <input name="serie_comprobante" type="text" class="form-control" placeholder="Serie del comprobante..." value="{{ $ingreso->serie_comprobante }}" />
                                @if ($errors->has('serie_comprobante'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('serie_comprobante') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <!-- Form Field Start -->
                            <div class="mb-3">
                                <label for="numero_comprobante" class="form-label">Número Comprobante</label>
                                <input name="numero_comprobante" type="text" class="form-control" placeholder="Número del comprobante..." value="{{ $ingreso->numero_comprobante }}" />
                                @if ($errors->has('numero_comprobante'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('numero_comprobante') }}</font>
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

