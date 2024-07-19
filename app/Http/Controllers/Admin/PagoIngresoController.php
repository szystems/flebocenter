<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PagoIngreso;
use App\Http\Requests\PagoIngresoFormRequest;
use App\Models\Ingreso;
use App\Models\IngresoDetalle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Config;
use App\Models\Bitacora;
use Carbon\Carbon;
use PDF;
use DB;

class PagoIngresoController extends Controller
{
    public function insert(PagoIngresoFormRequest $request)
    {
        $ingresoDetalles = IngresoDetalle::where('ingreso_id', $request->input('ingreso_id'))->get();
        $total = IngresoDetalle::where('ingreso_id', $request->input('ingreso_id'))->sum('sub_total');
        $pagos = PagoIngreso::where('ingreso_id', $request->input('ingreso_id'))->get();
        $totalAbonado = PagoIngreso::where('ingreso_id', $request->input('ingreso_id'))->sum('cantidad');
        $saldo = (float) str_replace(',', '', number_format($total - $totalAbonado, 2));
        $cantidad = (float) str_replace(',', '', $request->input('cantidad'));

        // dd($saldo, $cantidad);

        if ($cantidad <= $saldo) {
            $pago = new PagoIngreso();
            if($request->hasFile('imagen'))
            {
                $file = $request->file('imagen');
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('assets/imgs/pagos',$filename);
                $pago->imagen = $filename;
            }
            $pago->ingreso_id = $request->input('ingreso_id');
            $pago->tipo_pago = $request->input('tipo_pago');
            $pago->cantidad = $request->input('cantidad');
            $pago->save();

            return redirect('show-ingreso/'.$pago->ingreso_id)->with('status',__('Pago agregado exitosamente.'));
        }else {
            return redirect()->back()->with('status',__('La cantidad a abonar es mayor al total del ingreso.'));
        }


    }

    public function update(PagoIngresoFormRequest $request, $id)
    {
        $ingresoDetalles = IngresoDetalle::where('ingreso_id', $request->input('ingreso_id'))->get();
        $total = IngresoDetalle::where('ingreso_id', $request->input('ingreso_id'))->sum('sub_total');
        $pagos = PagoIngreso::where('ingreso_id', $request->input('ingreso_id'))->get();
        $totalAbonado = PagoIngreso::where('ingreso_id', $request->input('ingreso_id'))->sum('cantidad');

        if ($request->input('cantidad') <= ($total)) {
            $pago = PagoIngreso::find($id);
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

            return redirect('show-ingreso/'.$pago->ingreso_id)->with('status',__('Pago actualizado exitosamente.'));
        }else {
            return redirect()->back()->with('status',__('La cantidad a abonar es mayor al total del ingreso.'));
        }
    }

    public function destroy($id)
    {
        $pago = PagoIngreso::find($id);
        $ingreso = Ingreso::find($pago->ingreso_id);
        $pago->delete();
        return redirect('show-ingreso/'.$pago->ingreso_id)->with('status',__('Pago eliminado exitosamente.'));
    }
}
