<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Bariatria;
use App\Http\Requests\BariatriaFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Config;
use PDF;

class BariatriaController extends Controller
{
    public function show($id)
    {
        $bariatria = Bariatria::find($id);
        $paciente = Paciente::find($bariatria->paciente_id);
        return view('admin.paciente.bariatria.showbariatria', compact('bariatria', 'paciente'));
    }

    public function insert(BariatriaFormRequest $request)
    {
        $bariatria = new Bariatria();
        $bariatria->paciente_id = $request->input('paciente_id');
        $bariatria->fecha = $request->input('fecha');
        $bariatria->peso = $request->input('peso');
        $bariatria->talla = $request->input('talla');
        $bariatria->cci = $request->input('cci');
        $bariatria->cca = $request->input('cca');
        $bariatria->ccu = $request->input('ccu');
        $bariatria->imc = $request->input('imc');
        $bariatria->icc = $request->input('icc');
        $bariatria->ict = $request->input('ict');
        $bariatria->diagnostico = $request->input('diagnostico');
        $bariatria->kilocalorias = $request->input('kilocalorias');
        $bariatria->medicamentos = $request->input('medicamentos');
        $bariatria->suplementacion = $request->input('suplementacion');
        $bariatria->ejercicios = $request->input('ejercicios');
        $bariatria->comentarios = $request->input('comentarios');

        if($request->hasFile('pdf_path'))
        {
            $file = $request->file('pdf_path');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/bariatria/',$filename);
            $bariatria->pdf_path = $filename;
        }

        $bariatria->save();

        return redirect('show-bariatria/'.$bariatria->id)->with('status',__('Evaluación bariátrica agregada exitosamente.'));
    }

    public function update(BariatriaFormRequest $request, $id)
    {
        $bariatria = Bariatria::find($id);
        $bariatria->fecha = $request->input('fecha');
        $bariatria->peso = $request->input('peso');
        $bariatria->talla = $request->input('talla');
        $bariatria->cci = $request->input('cci');
        $bariatria->cca = $request->input('cca');
        $bariatria->ccu = $request->input('ccu');
        $bariatria->imc = $request->input('imc');
        $bariatria->icc = $request->input('icc');
        $bariatria->ict = $request->input('ict');
        $bariatria->diagnostico = $request->input('diagnostico');
        $bariatria->kilocalorias = $request->input('kilocalorias');
        $bariatria->medicamentos = $request->input('medicamentos');
        $bariatria->suplementacion = $request->input('suplementacion');
        $bariatria->ejercicios = $request->input('ejercicios');
        $bariatria->comentarios = $request->input('comentarios');

        if($request->hasFile('pdf_path'))
        {
            $path = 'assets/uploads/bariatria/'.$bariatria->pdf_path;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('pdf_path');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/bariatria/',$filename);
            $bariatria->pdf_path = $filename;
        }

        $bariatria->update();

        return redirect('show-bariatria/'.$bariatria->id)->with('status',__('Evaluación bariátrica actualizada exitosamente.'));
    }

    public function destroy($id)
    {
        $bariatria = Bariatria::find($id);
        
        if($bariatria->pdf_path)
        {
            $path = 'assets/uploads/bariatria/'.$bariatria->pdf_path;
            if(File::exists($path))
            {
                File::delete($path);
            }
        }
        
        $pacienteID = $bariatria->paciente_id;
        $bariatria->delete();
        return redirect('show-paciente/'.$pacienteID)->with('status',__('Evaluación bariátrica eliminada exitosamente.'));
    }

    public function uploadimagen(Request $request)
    {
        if ($request->hasFile('upload'))
        {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = \pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('assets/media'),$fileName);

            $url = asset('assets/media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function print(Request $request)
    {
        if ($request)
        {
            $config = Config::first();
            $bariatria = Bariatria::find($request->input('bariatria_id'));

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

            if ( $pdfarchivo == "download" )
            {
                $pdf = PDF::loadView('admin.paciente.bariatria.pdfbariatria', compact('imagen','bariatria','config'));
                $pdf->getDomPDF()->set_option("enable_html5_parser", true);
                $pdf->setPaper($pdftamaño, $pdfhorientacion);
                return $pdf->download ('Bariatria: '.$bariatria->id.' Paciente: '.$bariatria->paciente->nombre.'-'.$nompdf.'.pdf');
            }

            if ( $pdfarchivo == "stream" )
            {
                $pdf = PDF::loadView('admin.paciente.bariatria.pdfbariatria', compact('imagen','bariatria','config'));
                $pdf->getDomPDF()->set_option("enable_html5_parser", true);
                $pdf->setPaper($pdftamaño, $pdfhorientacion);
                return $pdf->stream ('Bariatria: '.$bariatria->id.' Paciente: '.$bariatria->paciente->nombre.'-'.$nompdf.'.pdf');
            }
        }
    }
}
