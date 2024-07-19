<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ingreso;
use App\Models\IngresoDetalle;
use App\Models\Proveedor;
use App\Models\Articulo;
use App\Models\Config;
use App\Http\Requests\IngresoFormRequest;
use App\Models\PagoIngreso;
use App\Http\Requests\PagoIngresoFormRequest;

use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class IngresoController extends Controller
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

            $proveedorId = $request->input('proveedor_id');
            $numeroComprobante = $request->input('numero_comprobante');
            $tipoComprobante = $request->input('tipo_comprobante');

            $Consultafiltros = Ingreso::where('fecha', '>=', $fechaDesde)
                                        ->where('fecha', '<=', $fechaHasta);

            if (!empty($proveedorId)) {
                $Consultafiltros->where('proveedor_id', '=', $proveedorId);
            }

            if (!empty($tipoComprobante)) {
                $Consultafiltros->where('tipo_comprobante', '=', $tipoComprobante);
            }

            if (!empty($numeroComprobante)) {
                $Consultafiltros->where('numero_comprobante', '=', $numeroComprobante);
            }

            if ($request->input('saldo') == 'Pagado') {
                $Consultafiltros->whereHas('pago_ingresos', function ($query) {
                    $query->havingRaw('SUM(cantidad) = (SELECT SUM(sub_total) FROM ingreso_detalles WHERE ingreso_id = ingresos.id)');
                });
            } elseif ($request->input('saldo') == 'Pendiente') {
                $Consultafiltros->whereHas('pago_ingresos', function ($query) {
                    $query->havingRaw('SUM(cantidad) < (SELECT SUM(sub_total) FROM ingreso_detalles WHERE ingreso_id = ingresos.id)');
                });
            }

            $Consultafiltros->orderBy('fecha','desc');
            $ingresos = $Consultafiltros->get();

            $proveedores = Proveedor::all();
            $config = Config::first();
            // dd($proveedores);
            return view('admin.ingreso.index', compact('ingresos','proveedores','config','fechaDesdeVista','fechaHastaVista'));
        }
    }

    public function show($id)
    {
        $ingreso = Ingreso::find($id);
        $ingresoDetalles = IngresoDetalle::where('ingreso_id', $ingreso->id)->get();
        $total = IngresoDetalle::where('ingreso_id', $id)->sum('sub_total');
        $pagos = PagoIngreso::where('ingreso_id', $id)->get();
        $totalAbonado = PagoIngreso::where('ingreso_id', $id)->sum('cantidad');
        $config = Config::first();
        return view('admin.ingreso.show', compact('ingreso','ingresoDetalles','total','pagos','totalAbonado','config'));
    }

    public function add()
    {
        $proveedores = Proveedor::where('estado', 1)->get();
        $articulos = Articulo::where('estado', 1)->get();
        $config = Config::first();
        return view('admin.ingreso.add', compact('proveedores', 'articulos','config'));
    }

    public function insert(IngresoFormRequest $request)
    {
        // dd($request->all());
        try
    	{
            $fecha=trim($request->input('fecha'));
            $fecha = date("Y-m-d", strtotime($fecha));

    		DB::beginTransaction();

    		$ingreso=new Ingreso;
    		$ingreso->proveedor_id=$request->input('proveedor_id');
    		$ingreso->tipo_comprobante=$request->input('tipo_comprobante');
    		$ingreso->serie_comprobante=$request->input('serie_comprobante');
            $ingreso->numero_comprobante=$request->input('numero_comprobante');
    		$ingreso->fecha=$fecha;
    		$ingreso->save();


    		$idarticulo = $request->input('idarticulo');
    		$cantidad = $request->input('cantidad');
    		$precio_compra = $request->input('precio_compra');
            $precio_venta = $request->input('precio_venta');

            $cont = 0;
            $total = 0;

    		while ($cont < count($idarticulo))
    		{
    			$detalle = new IngresoDetalle();
    			$detalle->ingreso_id=$ingreso->id;
    			$detalle->articulo_id=$idarticulo[$cont];
    			$detalle->cantidad=$cantidad[$cont];
    			$detalle->precio_compra=$precio_compra[$cont];
                $detalle->sub_total=$cantidad[$cont]*$precio_compra[$cont];
    			$detalle->save();

                //actualizamos stock y precios
                $artupt=Articulo::findOrFail($idarticulo[$cont]);
                $stocknuevo=$artupt->stock + $cantidad[$cont];
                $artupt->stock=$stocknuevo;
                $artupt->precio_compra=$precio_compra[$cont];
                $artupt->precio_venta=$precio_venta[$cont];
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

            $pago = new PagoIngreso();
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
            $pago->ingreso_id = $ingreso->id;
            $pago->cantidad = $request->input('pago');
            $pago->tipo_pago = $request->input('tipo_pago');
            $pago->save();

    		DB::commit();

    	}catch(\Exception $e)
    	{
    		DB::rollback();
    	}

    	return redirect('show-ingreso/'.$ingreso->id)->with('status',__('Ingreso creado correctamente!'));
    }




    public function destroy($id)
    {
        $ingreso = Ingreso::find($id);

        $detalles = IngresoDetalle::where('ingreso_id', $id)->get();

        foreach ($detalles as $detalle) {
            //actualizamos stock y precios
            $artupt=Articulo::findOrFail($detalle->articulo_id);
            $stocknuevo=$artupt->stock - $detalle->cantidad;
            $artupt->stock=$stocknuevo;
            $artupt->update();
        }

        $detalles = IngresoDetalle::where('ingreso_id', $id)->delete();
        $pagos = PagoIngreso::where('ingreso_id', $id)->delete();

        $ingreso->delete();

        return redirect('ingresos')->with('status',__('Ingreso eliminado correctamente.'));
    }
}
