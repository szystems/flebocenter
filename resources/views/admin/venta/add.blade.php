@extends('layouts.admin')
@section('content')

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Main header starts -->
        <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
                <div class="page-icon">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div class="page-title">
                    <h5>Ventas</h5>
                </div>
            </div>
            <!-- Date range start -->
            <div class="d-flex align-items-end d-none d-sm-block">
                <h6 class="float-end text-light" id="reloj"></h6>
            </div>
        </div>
        <!-- Main header ends -->

        <!-- Content wrapper start -->
        <div class="content-wrapper">


            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="custom-tabs-container">
                                <ul class="nav nav-tabs" id="customTab2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                                            aria-controls="oneA" aria-selected="true">Crear Venta</a>
                                    </li>
                                </ul>
                                <div class="tab-content h-350">
                                    <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                                        <!-- Row start -->
                                        <div class="row gx-3">
                                            <div class="col-sm-12 col-12">
                                                @if (count($errors)>0)
                                                    <div class="alert alert-danger text-white" role="alert">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{$error}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                @endif
                                                <form action="{{ url('insert-venta') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row gx-3">

                                                        <div class="col-md-12 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="nombre" class="form-label">Ingrese los datos de venta:</label>
                                                            </div>
                                                        </div>

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
                                                                    $( '#fecha').datepicker( 'setDate', today );
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
                                                                <label for="paciente_id" class="form-label">Paciente</label>
                                                                <select name="paciente_id" class="form-select" aria-label="Default select example" required>
                                                                    <option value="">Seleccione paciente</option>
                                                                    @foreach($pacientes as $paciente)
                                                                        <option value="{{ $paciente->id }}"{{ old('paciente_id') == $paciente->id ? ' selected' : '' }}>{{ $paciente->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('paciente_id'))
                                                                    <span class="help-block opacity-7">
                                                                        <strong>
                                                                            <font color="red">{{ $errors->first('paciente_id') }}</font>
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
                                                                    <option value=""{{ request('tipo_comprobante') == '' ? ' selected' : '' }}>Seleccione tipo...</option>
                                                                    <option value="Factura"{{ request('tipo_comprobante') == 'Factura' ? ' selected' : '' }}>Factura</option>
                                                                    <option value="Recibo"{{ request('tipo_comprobante') == 'Recibo' ? ' selected' : '' }}>Recibo</option>
                                                                    <option value="Boleta"{{ request('tipo_comprobante') == 'Boleta' ? ' selected' : '' }}>Boleta</option>
                                                                    <option value="Ticket"{{ request('tipo_comprobante') == 'Ticket' ? ' selected' : '' }}>Ticket</option>
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
                                                                <input name="serie_comprobante" type="text" class="form-control" placeholder="Serie del comprobante..." value="{{ old('serie_comprobante') }}" />
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
                                                                <input name="numero_comprobante" type="text" class="form-control" placeholder="Número del comprobante..." value="{{ old('numero_comprobante') }}" />
                                                                @if ($errors->has('numero_comprobante'))
                                                                    <span class="help-block opacity-7">
                                                                            <strong>
                                                                                <font color="red">{{ $errors->first('numero_comprobante') }}</font>
                                                                            </strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <h4>Detalles de venta:</h4>
                                                        <hr>

                                                        <div class="col-md-12 mb-3">
                                                            <!-- Form Field Start -->
                                                            <div class="mb-3">
                                                                <label for="articulo_id" class="form-label">Artículo</label>
                                                                <select name="pidarticulo" id="pidarticulo" class="form-select select2" aria-label="Default select example">
                                                                    <option value="">Seleccione articulo</option>
                                                                    @foreach($articulos as $articulo)
                                                                        <option value="{{$articulo->id}}_{{$articulo->codigo}}_{{number_format($articulo->precio_compra,2, '.', '')}}_{{number_format($articulo->precio_venta,2, '.', '')}}_{{ $articulo->stock }}"{{ old('articulo_id') == $articulo->id ? ' selected' : '' }}>
                                                                            {{ $articulo->codigo }} - {{ $articulo->nombre }} - {{ $config->currency_simbol }}.{{number_format($articulo->precio_venta,2, '.', '')}} - Stock: {{ $articulo->stock }}
                                                                        </option>
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

                                                        <script>
                                                            $(document).ready(function() {
                                                                $('#pidarticulo').select2({
                                                                    placeholder: 'Seleccione articulo',
                                                                    allowClear: true,
                                                                    minimumInputLength: 1
                                                                });
                                                            });
                                                        </script>

                                                        <div class="col-md-2 mb-3">
                                                            <label class="form-label">Cantidad</label>
                                                            <div class="input-group">
                                                                {{-- <span class="input-group-text">{{ $config->currency_simbol }}.</span> --}}
                                                                <input name="pcantidad" id="pcantidad" type="number" class="form-control" min="0" step="1" placeholder="0" value="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                            </div>
                                                            @if ($errors->has('pcantidad'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('pcantidad') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <input name="pprecio_compra" id="pprecio_compra" type="hidden" class="form-control" placeholder="0.00" step="0.01"  value="0.00">

                                                        <div class="col-md-3 mb-3">
                                                            <label class="form-label">Stock</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">Disponibles:</span>
                                                                <input readonly name="pstock" id="pstock" type="number" class="form-control" placeholder="0"  value="0">
                                                            </div>
                                                            @if ($errors->has('pstock'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('pstock') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-3 mb-3">
                                                            <label class="form-label">Precio Venta</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                                                <input name="pprecio_venta" id="pprecio_venta" type="number" class="form-control" placeholder="0.00" step="0.01" value="0.00">
                                                            </div>
                                                            @if ($errors->has('pprecio_venta'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('pprecio_venta') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-2 mb-3">
                                                            <label class="form-label">Descuento</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">%</span>
                                                                <input name="pdescuento" id="pdescuento" type="number" class="form-control" placeholder="0"  value="0">
                                                            </div>
                                                            @if ($errors->has('pdescuento'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">{{ $errors->first('pdescuento') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-2 mb-3">
                                                            {{-- <label class="form-label">Agregar</label> --}}
                                                            <div class="form-group mb-3 mt-4">
                                                                <button class="btn btn-info" type="button" id="bt_add"><i class="bi bi-plus-square"></i> Agregar</button>
                                                            </div>
                                                        </div>

                                                        <div class="table-responsive">
                                                            <table id="detalles" class="table align-middle table-striped flex-column">
                                                                <thead>
                                                                    <tr>
                                                                        <td align="left"><i class="bi bi-list-task"></i></td>
                                                                        <td align="left">Articulo</td>
                                                                        <td align="center">Cantidad</td>
                                                                        <td align="right">Precio Venta</td>
                                                                        <td align="right">Descuento Total</td>
                                                                        <td align="right">Sub-Total</td>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><input type="hidden" id="total_hidden" name="total_hiden" value="0"></td>
                                                                        <td align="right"><h4>Total Descuento: <strong id="totaldescuento"" class="text-warning">{{ $config->currency_simbol }}0.00</strong></h4></td>
                                                                        <td align="right"><h4>Total: <strong id="total" class="text-success">{{ $config->currency_simbol }}0.00</strong></h4></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="6" class="float-left">
                                                                            <div class="row gx-3">
                                                                                <div class="col-md-3 mb-3">
                                                                                    <label class="form-label">Abonar:</label>
                                                                                    <div class="form-group mb-0 mt-0">
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-text">{{ $config->currency_simbol }}.</span>
                                                                                            <input name="pago" id="pago" type="number" class="form-control" placeholder="0.00" step="0.01" value="0.00" required>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3 mb-3">
                                                                                    <label class="form-label">Tipo de Pago:</label>
                                                                                    <select id="tipo_pago" name="tipo_pago" class="form-select" aria-label="Default select example" required>
                                                                                        <option value="Efectivo"{{ request('tipo_pago') == 'Efectivo' ? ' selected' : '' }}>Efectivo</option>
                                                                                        <option value="Tarjeta"{{ request('tipo_pago') == 'Tarjeta' ? ' selected' : '' }}>Tarjeta</option>
                                                                                        <option value="Deposito"{{ request('tipo_pago') == 'Deposito' ? ' selected' : '' }}>Deposito</option>
                                                                                        <option value="Transferencia"{{ request('tipo_pago') == 'Transferencia' ? ' selected' : '' }}>Transferencia</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-3 mb-3">
                                                                                    <label class="form-label">Cargar Imagen:</label>
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
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                                <tbody>

                                                                </tbody>

                                                            </table>
                                                            {{-- {{ $ventas->links() }} --}}
                                                        </div>

                                                        <input type="hidden" name="moneda" class="form-control" id="moneda" value="{{ $config->currency_simbol }}">
                                                        <input type="hidden" name="descuento_maximo" class="form-control" id="descuento_maximo" value="{{ $config->descuento_maximo }}">

                                                    </div>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <div class="form-group" id="guardar">
                                                            <button class="btn btn-danger" type="reset"><i class="bi bi-x-circle"></i> Borrar</button>
                                                            <button class="btn btn-success" type="submit"><i class="bi bi-save"></i> Guardar</button>
                                                      </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Row end -->
                                    </div>

                                </div>
                                {{-- <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ url('edit-user/'.$user->id) }}" type="button" class="btn btn-outline-secondary">
                                        Cancelar
                                    </a>
                                    <button type="button" class="btn btn-success">
                                        Update
                                    </button>
                                </div> --}}
                                <input type="hidden" name="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
        </div>
        <!-- Content wrapper end -->
    </div>
    <!-- Content wrapper scroll end -->

    <script>


        $(document).ready(function(){
            $('#bt_add').click(function(){
                agregar();
            });
        });

        var cont=0;
        total=0;
        totaldescuento=0;
        totalimpuesto=0;
        total_compra=0;
        subtotal=[];
        subtotaldescuento=[];
        subtotalimpuesto=[];
        subtotalcompra=[];
        $("#guardar").hide();
        $("#pidarticulo").change(mostrarValores);

        function mostrarValores()
        {
            datosArticulo=document.getElementById('pidarticulo').value.split('_');
            $("#pstock").val(datosArticulo[4]);
            $("#pprecio_venta").val(datosArticulo[3]);
            $("#pprecio_compra").val(datosArticulo[2]);
            $("#pariculo_id").val(datosArticulo[0]);

        }

        function agregar()
        {
            datosArticulo=document.getElementById('pidarticulo').value.split('_');

            idarticulo=datosArticulo[0];
            articulo=$("#pidarticulo option:selected").text();
            cantidad=$("#pcantidad").val();

            descuento=$("#pdescuento").val();
            precio_venta=$("#pprecio_venta").val();
            precio_compra=$("#pprecio_compra").val();

            stock=$("#pstock").val();
            moneda=$("#moneda").val();
            descuento_maximo=$("#descuento_maximo").val();

            if (idarticulo!="" && cantidad!="" && cantidad>0 && descuento!="" && precio_venta!="" && precio_compra!="")
            {

                if (parseFloat(descuento) <= parseFloat(descuento_maximo))
                {
                    descuentoxunidad=((precio_venta*descuento)/100);
                    subtotal[cont]=(cantidad*precio_venta-(descuentoxunidad*cantidad));
                    total=total+subtotal[cont];

                    subtotaldescuento[cont]=(cantidad*descuentoxunidad);
                    totaldescuento=totaldescuento+subtotaldescuento[cont];

                    subtotalcompra[cont]=(cantidad*precio_compra);
                    total_compra=total_compra+subtotalcompra[cont];


                    var fila='<tr class="selected" id="fila'+cont+'"><td align="center"><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td align="left"><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td align="center"><input type="hidden" style="width:100%" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td><td align="right" class="text-success"><input type="hidden" style="width:100%" readonly name="precio_compra[]" value="'+precio_compra+'"><div class="input-group"><input readonly type="hidden" readonly name="precio_venta[]" value="'+precio_venta+'" class="form-control" placeholder="0.00" step="0.01"></div>'+moneda+'.'+precio_venta+'</td><td align="right" class="text-warning"><div class="input-group"><input readonly type="hidden" readonly name="descuento[]" value="'+descuentoxunidad*cantidad+'" class="form-control" placeholder="0.00" step="0.01"></div>'+moneda+'.'+(descuentoxunidad*cantidad).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')+'</td><td align="right" class="text-success"><strong>{{Auth::user()->moneda}}'+moneda+'.'+subtotal[cont].toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')+'</strong></td></tr>';
                    cont++;
                    limpiar();
                    $("#total").html(moneda + total.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
                    $("#total_hidden").val(total.toFixed(2));
                    $("#total_venta").val(total);
                    $("#pago").val(total.toFixed(2));

                    $("#totaldescuento").html(moneda + totaldescuento.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
                    $("#total_descuento").val(totaldescuento);

                    $("#total_compra").val(total_compra);

                    evaluar();


                    $("#abonado").val(total.toFixed(2));
                    $("#total_abonado").val(total.toFixed(2));
                    $('#pidarticulo').val("Seleccione un Articulo");
                    $('#pidarticulo').change();
                    $('#detalles').append(fila);
                }
                else
                {
                    alert ('El descuento supera el porcentaje maximo de descuento permitido');
                }



            }
            else
            {
                alert("Error al ingresar el detalle de la Venta, revise los datos del articulo");
            }
        }

        function limpiar()
        {
            $("#pcantidad").val("1");
            $("#pdescuento").val("0");
            $("#pprecio_venta").val("");
            $("#pprecio_compra").val("");
            $("#pstock").val("");
        }

        function evaluar()
        {
            if (total>0)
            {
                $("#guardar").show();
            }
            else
            {
                $("#guardar").hide();
            }
        }

        function eliminar(index)
        {
            total=total-subtotal[index];
            totaldescuento=totaldescuento-subtotaldescuento[index];
            total_compra=total_compra-subtotalcompra[index];

            $("#total").html("Q. " + total.toFixed(2));
            $("#total_venta").val(total.toFixed(2));
            $("#abonado").val(total.toFixed(2));
            $("#pago").val(total.toFixed(2));
            $("#total_compra").val(total_compra.toFixed(2));
            $("#totaldescuento").html("Q. " + totaldescuento.toFixed(2));
            $("#total_descuento").val(totaldescuento.toFixed(2));
            $("#pabonado").val(total.toFixed(2));
            $("#fila" + index).remove();
            evaluar();
        }

        function validardecimal(e,txt)
        {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla==8) return true;
            if (tecla==46 && txt.indexOf('.') != -1) return false;
            patron = /[\d\.]/;
            te = String.fromCharCode(tecla);
            return patron.test(te);
        }

        function validarentero(e,txt)
        {
            tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla==8)
            {
                return true;
            }

            // Patron de entrada, en este caso solo acepta numeros
            patron =/[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }

    </script>


@endsection
