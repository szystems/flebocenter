<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Receta;
use App\Models\Config;
use App\Http\Requests\RecetaFormRequest;
use PDF;
use DB;

class RecetaController extends Controller
{

    public function insert(RecetaFormRequest $request)
    {
        $fecha = date("Y-m-d", strtotime($request->fecha));
        $receta = new Receta();
        $receta->paciente_id = $request->input('paciente_id');
        $receta->doctor_id = $request->input('doctor_id');
        $receta->fecha = $fecha;
        $receta->descripcion = $request->input('descripcion');
        $receta->save();

        return redirect('show-paciente/'.$receta->paciente_id)->with('status',__('Receta creada correctamente!'));
    }

    public function update(RecetaFormRequest $request, $id)
    {
        $paciente_id = $request->input('paciente_id');
        $receta = Receta::find($id);
        $receta->descripcion = $request->input('descripcion');
        $receta->update();
        return redirect('show-paciente/'.$paciente_id)->with('status',__('Receta actualizada correctamente!'));

    }

    public function delete(Request $request, $id)
    {
        $paciente_id = $request->input('paciente_id');
        $receta = Receta::find($id);
        $receta->delete();
        return redirect('show-paciente/'.$paciente_id)->with('status',__('Receta eliminada correctamente!'));
    }

    public function print(Request $request)
    {
        // dd($request);
        if ($request)
        {
            $config = Config::first();
            $receta = Receta::find($request->input('receta_id'));


            $nompdf = date('m/d/Y g:ia');
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

            if ( $pdfarchivo == "download" )
            {
                $pdf = PDF::loadView('admin.paciente.receta.pdfreceta', compact('imagen','receta','config','imagen'));
                if($request->input('pdftamaño') == 'Media Carta'){
                    $pdf->setPaper(array(0, 0, 396, 612), $pdfhorientacion);
                }else{
                    $pdf->setPaper($pdftamaño, $pdfhorientacion);
                }
                return $pdf->download ('Receta: '.$receta->id.'-'.$nompdf.'.pdf');
            }
            if ( $pdfarchivo == "stream" )
            {
                $pdf = PDF::loadView('admin.paciente.receta.pdfreceta', compact('imagen','receta','config','imagen'));
                if($request->input('pdftamaño') == 'Media Carta'){
                    $pdf->setPaper(array(0, 0, 396, 612), $pdfhorientacion);
                }else{
                    $pdf->setPaper($pdftamaño, $pdfhorientacion);
                }
                return $pdf->stream ('Receta: '.$receta->id.'-'.$nompdf.'.pdf');
            }
        }
    }
}
