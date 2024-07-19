<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PagoVenta;
use App\Http\Requests\PagoVentaFormRequest;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Config;
use App\Models\Bitacora;
use Carbon\Carbon;
use PDF;
use DB;

class PagoVentaController extends Controller
{
    public function insert(PagoVentaFormRequest $request)
    {
        $ventaDetalles = VentaDetalle::where('venta_id', $request->input('venta_id'))->get();
        $total = VentaDetalle::where('venta_id', $request->input('venta_id'))->sum('sub_total');
        $pagos = PagoVenta::where('venta_id', $request->input('venta_id'))->get();
        $totalAbonado = PagoVenta::where('venta_id', $request->input('venta_id'))->sum('cantidad');
        $saldo = (float) str_replace(',', '', number_format($total - $totalAbonado, 2));
        $cantidad = (float) str_replace(',', '', $request->input('cantidad'));

        // dd($saldo, $cantidad);

        if ($cantidad <= $saldo) {
            $pago = new PagoVenta();
            if($request->hasFile('imagen'))
            {
                $file = $request->file('imagen');
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('assets/imgs/pagos',$filename);
                $pago->imagen = $filename;
            }
            $pago->venta_id = $request->input('venta_id');
            $pago->tipo_pago = $request->input('tipo_pago');
            $pago->cantidad = $request->input('cantidad');
            $pago->save();

            return redirect('show-venta/'.$pago->venta_id)->with('status',__('Pago agregado exitosamente.'));
        }else {
            return redirect()->back()->with('status',__('La cantidad a abonar es mayor al total del venta.'));
        }


    }

    public function update(PagoVentaFormRequest $request, $id)
    {
        $ventaDetalles = VentaDetalle::where('venta_id', $request->input('venta_id'))->get();
        $total = VentaDetalle::where('venta_id', $request->input('venta_id'))->sum('sub_total');
        $pagos = PagoVenta::where('venta_id', $request->input('venta_id'))->get();
        $totalAbonado = PagoVenta::where('venta_id', $request->input('venta_id'))->sum('cantidad');


        if ($request->input('cantidad') <= ($total)) {
            $pago = PagoVenta::find($id);
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
            $pago->tipo_pago = $request->input('tipo_pago');
            $pago->cantidad = $request->input('cantidad');
            $pago->update();

            return redirect('show-venta/'.$pago->venta_id)->with('status',__('Pago actualizado exitosamente.'));
        }else {
            return redirect()->back()->with('status',__('La cantidad a abonar es mayor al total del venta.'));
        }
    }

    public function destroy($id)
    {
        $pago = PagoVenta::find($id);
        $venta = Venta::find($pago->venta_id);
        $pago->delete();
        return redirect('show-venta/'.$pago->venta_id)->with('status',__('Pago eliminado exitosamente.'));
    }
}
