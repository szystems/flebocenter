<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Venta;
use App\Models\VentaDetalle;
use App\Models\Paciente;
use App\Models\Articulo;
use App\Models\Config;
use App\Http\Requests\VentaFormRequest;
use App\Models\PagoVenta;
use App\Http\Requests\PagoVentaFormRequest;

use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        if ($request) {
            //obtengo datos
            if ($request->input('fecha_desde') != "") {
                $fechaDesdeVista = date("d-m-Y", strtotime($request->input('fecha_desde')));
                $fechaDesde = date("Y-m-d", strtotime($request->input('fecha_desde')));
            }else
            {
                $hoy = Carbon::now('America/Guatemala');
                $fechaDesdeVista = $hoy->format('d-m-Y');
                $fechaDesde = date("Y-m-d", strtotime($fechaDesdeVista));
            }

            if ($request->input('fecha_hasta') != "") {
                $fechaHastaVista = date("d-m-Y", strtotime($request->input('fecha_hasta')));
                $fechaHasta = date("Y-m-d", strtotime($request->input('fecha_hasta')));
            }else
            {
                $hoy = Carbon::now('America/Guatemala');
                $fechaHastaVista = $hoy->format('d-m-Y');
                $fechaHasta = date("Y-m-d", strtotime($fechaHastaVista));
            }

            $pacienteId = $request->input('paciente_id');
            $numeroComprobante = $request->input('numero_comprobante');
            $tipoComprobante = $request->input('tipo_comprobante');

            $Consultafiltros = Venta::where('fecha', '>=', $fechaDesde)
                                        ->where('fecha', '<=', $fechaHasta);

            if (!empty($pacienteId)) {
                $Consultafiltros->where('paciente_id', '=', $pacienteId);
            }

            if (!empty($tipoComprobante)) {
                $Consultafiltros->where('tipo_comprobante', '=', $tipoComprobante);
            }

            if (!empty($numeroComprobante)) {
                $Consultafiltros->where('numero_comprobante', '=', $numeroComprobante);
            }

            if ($request->input('saldo') == 'Pagado') {
                $Consultafiltros->whereHas('pago_ventas', function ($query) {
                    $query->havingRaw('SUM(cantidad) = (SELECT SUM(sub_total) FROM venta_detalles WHERE venta_id = ventas.id)');
                });
            } elseif ($request->input('saldo') == 'Pendiente') {
                $Consultafiltros->whereHas('pago_ventas', function ($query) {
                    $query->havingRaw('SUM(cantidad) < (SELECT SUM(sub_total) FROM venta_detalles WHERE venta_id = ventas.id)');
                });
            }

            $Consultafiltros->orderBy('fecha','desc');
            $ventas = $Consultafiltros->get();

            $pacientes = Paciente::all();
            $config = Config::first();
            // dd($pacientees);
            return view('admin.venta.index', compact('ventas','pacientes','config','fechaDesdeVista','fechaHastaVista'));
        }
    }

    public function show($id)
    {
        $venta = Venta::find($id);
        $ventaDetalles = VentaDetalle::where('venta_id', $venta->id)->get();
        $total = VentaDetalle::where('venta_id', $id)->sum('sub_total');
        $pagos = PagoVenta::where('venta_id', $id)->get();
        $totalAbonado = PagoVenta::where('venta_id', $id)->sum('cantidad');
        $config = Config::first();
        return view('admin.venta.show', compact('venta','ventaDetalles','total','pagos','totalAbonado','config'));
    }

    public function add()
    {
        $pacientes = Paciente::where('estado', 1)->get();
        $articulos = Articulo::where('estado', 1)->get();
        $config = Config::first();
        return view('admin.venta.add', compact('pacientes', 'articulos','config'));
    }

    public function insert(VentaFormRequest $request)
    {
        // dd($request->all());
        try
    	{
            $fecha=trim($request->input('fecha'));
            $fecha = date("Y-m-d", strtotime($fecha));

    		DB::beginTransaction();

    		$venta=new Venta;
    		$venta->paciente_id=$request->input('paciente_id');
    		$venta->tipo_comprobante=$request->input('tipo_comprobante');
    		$venta->serie_comprobante=$request->input('serie_comprobante');
            $venta->numero_comprobante=$request->input('numero_comprobante');
    		$venta->fecha=$fecha;
    		$venta->save();


    		$idarticulo = $request->input('idarticulo');
    		$cantidad = $request->input('cantidad');
    		$precio_compra = $request->input('precio_compra');
            $precio_venta = $request->input('precio_venta');
            $descuento = $request->input('descuento');

            $cont = 0;
            $total = 0;

    		while ($cont < count($idarticulo))
    		{
    			$detalle = new VentaDetalle();
    			$detalle->venta_id=$venta->id;
    			$detalle->articulo_id=$idarticulo[$cont];
    			$detalle->cantidad=$cantidad[$cont];
    			$detalle->precio_compra=$precio_compra[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->descuento=$descuento[$cont];
                $detalle->sub_total=($cantidad[$cont]*$precio_venta[$cont]-$descuento[$cont]);
    			$detalle->save();

                //actualizamos stock y precios
                $artupt=Articulo::findOrFail($idarticulo[$cont]);
                $stocknuevo=$artupt->stock - $cantidad[$cont];
                $artupt->stock=$stocknuevo;
                $artupt->update();

                $cont=$cont+1;
    		}

            $pago = $request->input('pago');
            $tipo_pago = $request->input('tipo_pago');

            $facturaTotal = floatval($request->input('total_hiden'));

            $validator = Validator::make($request->all(), [
                'pago' => [
                    'required',
                    'numeric',
                    function ($attribute, $value, $fail) use ($facturaTotal) {
                        if ($value > $facturaTotal) {
                            $fail('El abono no puede ser mayor que el total de la factura de compra.');
                        }
                    },
                ],
            ]);

            if ($validator->fails()) {
                // si la validación falló, redirigir con los errores
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $pago = new PagoVenta();
            if($request->hasFile('imagen'))
            {
                $path = 'assets/imgs/pagos/'.$pago->imagen;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $file = $request->file('imagen');
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('assets/imgs/pagos',$filename);
                $pago->imagen = $filename;
            }
            $pago->venta_id = $venta->id;
            $pago->cantidad = $request->input('pago');
            $pago->tipo_pago = $request->input('tipo_pago');
            $pago->save();

    		DB::commit();

    	}catch(\Exception $e)
    	{
    		DB::rollback();
    	}

    	return redirect('show-venta/'.$venta->id)->with('status',__('Venta creada correctamente!'));
    }

    public function edit($id)
    {
        $venta = Venta::find($id);
        $ventaDetalles = VentaDetalle::where('venta_id', $venta->id)->get();
        $total = VentaDetalle::where('venta_id', $id)->sum('sub_total');
        $pagos = PagoVenta::where('venta_id', $id)->get();
        $totalAbonado = PagoVenta::where('venta_id', $id)->sum('cantidad');
        $config = Config::first();
        $pacientes = Paciente::where('estado', 1)->get();
        $articulos = Articulo::where('estado', 1)->get();
        return view('admin.venta.edit', \compact('venta','ventaDetalles','total','pagos','totalAbonado','config','pacientes','articulos'));
    }

    public function update(Request $request, $id)
    {
        $fecha=trim($request->input('fecha'));
        $fecha = date("Y-m-d", strtotime($fecha));

        $venta= Venta::find($id);
        $venta->paciente_id=$request->input('paciente_id');
        $venta->tipo_comprobante=$request->input('tipo_comprobante');
        $venta->serie_comprobante=$request->input('serie_comprobante');
        $venta->numero_comprobante=$request->input('numero_comprobante');
        $venta->fecha=$fecha;
        $venta->save();

        return redirect('show-venta/'.$id)->with('status',__('Venta actualizada correctamente!'));
    }

    public function destroy($id)
    {
        $venta = Venta::find($id);

        $detalles = VentaDetalle::where('venta_id', $id)->get();

        foreach ($detalles as $detalle) {
            //actualizamos stock
            $artupt=Articulo::findOrFail($detalle->articulo_id);
            $stocknuevo=$artupt->stock + $detalle->cantidad;
            $artupt->stock=$stocknuevo;
            $artupt->update();
        }

        $detalles = VentaDetalle::where('venta_id', $id)->delete();
        $pagos = PagoVenta::where('venta_id', $id)->delete();

        $venta->delete();

        return redirect('ventas')->with('status',__('Venta eliminada     correctamente.'));
    }

    public function destroydetalle($id)
    {
        $detalle = VentaDetalle::find($id);

        $venta = Venta::find($detalle->venta_id);

        $artupt=Articulo::findOrFail($detalle->articulo_id);
        $stocknuevo=$artupt->stock + $detalle->cantidad;
        $artupt->stock=$stocknuevo;
        $artupt->update();

        $detalle->delete();

        return redirect('edit-venta/'.$venta->id)->with('status',__('Detalle de venta eliminado correctamente!'));
    }

    public function insertdetalle(Request $request)
    {
        // dd($request->all());
        // try
    	// {
            $venta = Venta::find($request->input('venta_id'));
            $articulo = Articulo::find($request->input('pidarticulo'));
            $config = Config::first();

            $descuento = $request->input('pdescuento');
            $cantidad = $request->input('pcantidad');

            $detalle = new VentaDetalle();
            $detalle->venta_id=$venta->id;
            $detalle->articulo_id=$articulo->id;
            $detalle->cantidad=$cantidad;
            $detalle->precio_compra=$articulo->precio_compra;
            $detalle->precio_venta=$articulo->precio_venta;


            if ($descuento <= $config->descuento_maximo)
            {
                $descuentoxunidad=(($articulo->precio_venta*$descuento)/100);
                $subtotal=($cantidad*$articulo->precio_venta-($descuentoxunidad*$cantidad));

                $subtotaldescuento=($cantidad*$descuentoxunidad);

            }else
            {
                return redirect('edit-venta/'.$venta->id)->with('status',__('El descuento excede el permitido'));
            }

            $detalle->descuento=$subtotaldescuento;
            $detalle->sub_total=$subtotal;
            $detalle->save();

            //actualizamos stock y precios
            $artupt=Articulo::findOrFail($articulo->id);
            $stocknuevo=$artupt->stock - $cantidad;
            $artupt->stock=$stocknuevo;
            $artupt->update();

    	// 	DB::commit();

    	// }catch(\Exception $e)
    	// {
    	// 	DB::rollback();
    	// }

    	return redirect('edit-venta/'.$venta->id)->with('status',__('Detalle de venta agregada correctamente!'));
    }
}
