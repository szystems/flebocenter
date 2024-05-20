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

use Carbon\Carbon;

class IngresoController extends Controller
{
    public function index(Request $request)
    {
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
            $tipoPago = $request->input('tipo_pago');

            $Consultafiltros = Ingreso::where('fecha', '>=', $fechaDesde)
                                        ->where('fecha', '<=', $fechaHasta);

            if (!empty($proveedorId)) {
                $Consultafiltros->where('proveedor_id', '=', $proveedorId);
            }

            if (!empty($tipoComprobante)) {
                $Consultafiltros->where('tipo_comprobante', '=', $tipoComprobante);
            }

            if (!empty($tipoPago)) {
                $Consultafiltros->where('tipo_pago', '=', $tipoPago);
            }

            if (!empty($numeroComprobante)) {
                $Consultafiltros->where('numero_comprobante', '=', $numeroComprobante);
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
        $config = Config::first();
        return view('admin.ingreso.show', compact('ingreso','ingresoDetalles','config'));
    }

    public function create()
    {
        $proveedores = Proveedor::where('estado', 1);
        $articulos = Articulo::where('estado', 1);

        return view('ingresos.create', compact('proveedores', 'articulos'));
    }

    public function store(IngresoRequest $request)
    {
        $ingreso = Ingreso::create($request->validated());

        foreach ($request->input('articulos') as $articulo) {
            IngresoDetalle::create([
                'ingreso_id' => $ingreso->id,
                'articulo_id' => $articulo['id'],
                'cantidad' => $articulo['cantidad'],
                'precio_compra' => $articulo['precio_compra'],
                'descuento' => $articulo['descuento'],
                'sub_total' => $articulo['sub_total'],
            ]);
        }

        return redirect()->route('ingresos.index')->with('success', 'Ingreso creado exitosamente.');
    }



    public function edit(Ingreso $ingreso)
    {
        $proveedores = Proveedor::where('estado', 1);
        $articulos = Articulo::where('estado', 1);

        return view('ingresos.edit', compact('ingreso', 'proveedores', 'articulos'));
    }

    public function update(IngresoRequest $request, Ingreso $ingreso)
    {
        $ingreso->update($request->validated());

        return redirect()->route('ingresos.index')->with('success', 'Ingreso actualizado exitosamente.');
    }

    public function destroy(Ingreso $ingreso)
    {
        $ingreso->delete();

        return redirect()->route('ingresos.index')->with('success', 'Ingreso eliminado exitosamente.');
    }
}
