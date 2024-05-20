<!-- Row start -->
<div class="row gx-3">
    <div class="col-xl-12">
        <div class="card card-background-mask-info">
            {{-- <div class="card-header">
                <div class="card-title"><u>Doctores</u></div>
            </div> --}}
            <div class="card-body">

                <div class="accordion" id="accordionSpecialTitle">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSpecialTitleOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSpecialTitleOne" aria-expanded="true"
                                aria-controls="collapseSpecialTitleOne">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-filter text-info"></i>
                                    <div class="ms-3">
                                        <h5 class="text-yellow">Filtros de Búsqueda</h5>
                                        {{-- <p class="m-0 fw-normal">Leader</p> --}}

                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseSpecialTitleOne" class="accordion-collapse collapse"
                            aria-labelledby="headingSpecialTitleOne" data-bs-parent="#accordionSpecialTitle">
                            <div class="accordion-body">
                                <form action="{{ url('ingresos') }}" method="GET">
                                    @csrf
                                    <div class="row gx-3">

                                        <div class="col-md-4 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-2">
                                                <label for="fecha_desde" class="form-label">Fecha Desde</label>
                                                <div class="input-group">
                                                    <input type="text" name="fecha_desde" class="form-control datepicker" id="fecha_desde" value="{{ $fechaDesdeVista }}"/>
                                                    <span class="input-group-text">
                                                        <i class="bi bi-calendar4"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-2">
                                                <label for="fecha_hasta" class="form-label">Fecha Hasta</label>
                                                <div class="input-group">
                                                    <input type="text" name="fecha_hasta" class="form-control datepicker" id="fecha_hasta" value="{{ $fechaHastaVista }}"/>
                                                    <span class="input-group-text">
                                                        <i class="bi bi-calendar4"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="proveedor" class="form-label">Proveedor</label>
                                                <select name="proveedor_id" class="form-select" aria-label="Default select example">
                                                    <option value="">Todos</option>
                                                    @foreach($proveedores as $proveedor)
                                                        <option value="{{ $proveedor->id }}"{{ old('proveedor_id', request('proveedor_id')) == $proveedor->id ? ' selected' : '' }}>{{ $proveedor->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="tipo_comprobante" class="form-label">Tipo Comprobante</label>
                                                <select name="tipo_comprobante" class="form-select" aria-label="Default select example">
                                                    <option value=""{{ request('tipo_comprobante') == '' ? ' selected' : '' }}>Todos</option>
                                                    <option value="Factura"{{ request('tipo_comprobante') == 'Factura' ? ' selected' : '' }}>Factura</option>
                                                    <option value="Recibo"{{ request('tipo_comprobante') == 'Recibo' ? ' selected' : '' }}>Recibo</option>
                                                    <option value="Boleta"{{ request('tipo_comprobante') == 'Boleta' ? ' selected' : '' }}>Boleta</option>
                                                    <option value="Ticket"{{ request('tipo_comprobante') == 'Ticket' ? ' selected' : '' }}>Ticket</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="numero_comprobante" class="form-label">Número Comprobante</label>
                                                <input class="form-control" placeholder="Número de comprobante..." name="numero_comprobante" value="{{ old('numero_comprobante', request('numero_comprobante')) }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="tipo_pago" class="form-label">Tipo Pago</label>
                                                <select name="tipo_pago" class="form-select" aria-label="Default select example">
                                                    <option value=""{{ request('tipo_pago') == '' ? ' selected' : '' }}>Todos</option>
                                                    <option value="Efectivo"{{ request('tipo_pago') == 'Efectivo' ? ' selected' : '' }}>Efectivo</option>
                                                    <option value="Tarjeta"{{ request('tipo_pago') == 'Tarjeta' ? ' selected' : '' }}>Tarjeta</option>
                                                    <option value="Deposito"{{ request('tipo_pago') == 'Deposito' ? ' selected' : '' }}>Deposito</option>
                                                    <option value="Transferencia"{{ request('tipo_pago') == 'Transferencia' ? ' selected' : '' }}>Transferencia</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <!-- Form Field Start -->
                                            <div class="mb-3 mt-4">
                                                <button type="submit" class="btn btn-info">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
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
    $( '#fecha_desde' ).datepicker( optSimple );
    $( '#fecha_hasta' ).datepicker( optSimple );
</script>

<!-- Row end -->
