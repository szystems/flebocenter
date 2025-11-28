<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Seguimiento;
use App\Models\Config;
use App\Http\Requests\SeguimientoFormRequest;
use PDF;
use DB;

class SeguimientoController extends Controller
{
    public function insert(SeguimientoFormRequest $request)
    {
        // $fecha = date("Y-m-d", strtotime($request->fecha));
        $seguimiento = new Seguimiento();
        $seguimiento->paciente_id = $request->input('paciente_id');
        $seguimiento->doctor_id = $request->input('doctor_id');
        $seguimiento->fecha = $request->input('fecha');
        $seguimiento->descripcion = $request->input('descripcion');
        $seguimiento->save();

        return redirect('show-paciente/'.$seguimiento->paciente_id)->with('status',__('Seguimiento creado correctamente!'));
    }

    public function update(SeguimientoFormRequest $request, $id)
    {
        $paciente_id = $request->input('paciente_id');
        $seguimiento = Seguimiento::find($id);
        $seguimiento->fecha = $request->input('fecha');
        $seguimiento->descripcion = $request->input('descripcion');
        $seguimiento->update();
        return redirect('show-paciente/'.$paciente_id)->with('status',__('Seguimiento actualizado correctamente!'));

    }

    public function delete(Request $request, $id)
    {
        $paciente_id = $request->input('paciente_id');
        $seguimiento = Seguimiento::find($id);
        $seguimiento->delete();
        return redirect('show-paciente/'.$paciente_id)->with('status',__('Seguimiento eliminado correctamente!'));
    }

    public function print(Request $request)
    {
        // dd($request);
        if ($request)
        {
            $config = Config::first();
            $seguimiento = Seguimiento::find($request->input('seguimiento_id'));


            $nompdf = date('Y-m-d_H-i-s');
            $path = public_path('assets/imgs/');

            $currency = $config->currency_simbol;

            if ($config->logo == null)
            {
                $logo = null;
                $imagen = null;
            }
            else
            {
                    $logo = $config->logo;
                    $imagen = public_path('assets/imgs/logos/'.$logo);
            }

            //recibir detalles de la impresion
            $pdftamaño = $request->input('pdftamaño');
            $pdfhorientacion = $request->input('pdfhorientacion');
            $pdfarchivo = $request->input('pdfarchivo');
            $pdfletra = $request->input('pdfletra');

            if ( $pdfarchivo == "download" )
            {
                $pdf = PDF::loadView('admin.paciente.seguimiento.pdfseguimiento', compact('imagen','seguimiento','config','imagen','pdfletra'));
                if($request->input('pdftamaño') == 'Media Carta'){
                    $pdf->setPaper(array(0, 0, 396, 612), $pdfhorientacion);
                }else{
                    $pdf->setPaper($pdftamaño, $pdfhorientacion);
                }
                return $pdf->download ('Seguimiento: '.$seguimiento->id.'-'.$nompdf.'.pdf');
            }
            if ( $pdfarchivo == "stream" )
            {
                $pdf = PDF::loadView('admin.paciente.seguimiento.pdfseguimiento', compact('imagen','seguimiento','config','imagen','pdfletra'));
                if($request->input('pdftamaño') == 'Media Carta'){
                    $pdf->setPaper(array(0, 0, 396, 612), $pdfhorientacion);
                }else{
                    $pdf->setPaper($pdftamaño, $pdfhorientacion);
                }
                return $pdf->stream ('Seguimiento: '.$seguimiento->id.'-'.$nompdf.'.pdf');
            }
        }
    }
}
