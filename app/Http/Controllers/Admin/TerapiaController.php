<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Paciente;
use App\Models\Terapia;
use App\Http\Requests\TerapiaFormRequest;
use App\Models\TerapiaSesionDerecha;
use App\Http\Requests\TerapiaSesionDerechaFormRequest;
use App\Models\TerapiaSesionIzquierda;
use App\Http\Requests\TerapiaSesionIzquierdaFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Config;
use PDF;
use DB;

class TerapiaController extends Controller
{
    public function show($id)
    {
        $terapia = Terapia::find($id);
        $paciente = Paciente::find($terapia->paciente_id);
        $sesionesDerecha = TerapiaSesionDerecha::where('terapia_id', $id)->get();
        $sesionesIzquierda = TerapiaSesionIzquierda::where('terapia_id', $id)->get();
        return view('admin.paciente.terapia.showterapia', compact('terapia','paciente','sesionesDerecha','sesionesIzquierda'));
    }

    public function insert(TerapiaFormRequest $request)
    {
        $terapia = new Terapia();
        $terapia->paciente_id = $request->input('paciente_id');
        $terapia->talla_media = $request->input('talla_media');
        $terapia->diagnostico = $request->input('diagnostico');
        $terapia->observaciones = $request->input('observaciones');
        $terapia->save();

        return redirect('show-terapia/'.$terapia->id)->with('status',__('Terapia agregada exitosamente.'));
    }

    public function update(TerapiaFormRequest $request, $id)
    {
        $terapia = Terapia::find($id);
        $terapia->talla_media = $request->input('talla_media');
        $terapia->diagnostico = $request->input('diagnostico');
        $terapia->observaciones = $request->input('observaciones');
        $terapia->update();

        return redirect('show-terapia/'.$terapia->id)->with('status',__('Terapia actualizada exitosamente.'));
    }

    public function destroy($id)
    {
        $terapia = Terapia::find($id);
        TerapiaSesionDerecha::where('terapia_id', $id)->delete();
        TerapiaSesionIzquierda::where('terapia_id', $id)->delete();
        $pacienteID = $terapia->paciente_id;
        $terapia->delete();
        return redirect('show-paciente/'.$pacienteID)->with('status',__('Terapia eliminada exitosamente.'));
    }

    public function insertsesionizquierda(TerapiaSesionIzquierdaFormRequest $request)
    {
        $sesion = new TerapiaSesionIzquierda();
        $sesion->terapia_id = $request->input('terapia_id');
        $sesion->antes1 = $request->input('antes1');
        $sesion->antes2 = $request->input('antes2');
        $sesion->antes3 = $request->input('antes3');
        $sesion->antes4 = $request->input('antes4');
        $sesion->despues1 = $request->input('despues1');
        $sesion->despues2 = $request->input('despues2');
        $sesion->despues3 = $request->input('despues3');
        $sesion->despues4 = $request->input('despues4');
        $sesion->save();

        $terapia = Terapia::find($sesion->terapia_id);
        $terapia->update();

        return redirect('show-terapia/'.$sesion->terapia_id)->with('status',__('Sesion agregada exitosamente.'));
    }

    public function updatesesionizquierda(TerapiaSesionIzquierdaFormRequest $request, $id)
    {
        $sesion = TerapiaSesionIzquierda::find($id);
        $sesion->antes1 = $request->input('antes1');
        $sesion->antes2 = $request->input('antes2');
        $sesion->antes3 = $request->input('antes3');
        $sesion->antes4 = $request->input('antes4');
        $sesion->despues1 = $request->input('despues1');
        $sesion->despues2 = $request->input('despues2');
        $sesion->despues3 = $request->input('despues3');
        $sesion->despues4 = $request->input('despues4');
        $sesion->update();

        $terapia = Terapia::find($sesion->terapia_id);
        $terapia->update();

        return redirect('show-terapia/'.$sesion->terapia_id)->with('status',__('Sesion actualizada exitosamente.'));
    }

    public function destroysesionizquierda($id)
    {
        $sesion = TerapiaSesionIzquierda::find($id);
        $sesion->delete();
        return redirect('show-terapia/'.$sesion->terapia_id)->with('status',__('Sesion eliminada exitosamente.'));
    }

    public function insertsesionderecha(TerapiaSesionDerechaFormRequest $request)
    {
        $sesion = new TerapiaSesionDerecha();
        $sesion->terapia_id = $request->input('terapia_id');
        $sesion->antes1 = $request->input('antes1');
        $sesion->antes2 = $request->input('antes2');
        $sesion->antes3 = $request->input('antes3');
        $sesion->antes4 = $request->input('antes4');
        $sesion->despues1 = $request->input('despues1');
        $sesion->despues2 = $request->input('despues2');
        $sesion->despues3 = $request->input('despues3');
        $sesion->despues4 = $request->input('despues4');
        $sesion->save();

        $terapia = Terapia::find($sesion->terapia_id);
        $terapia->update();

        return redirect('show-terapia/'.$sesion->terapia_id)->with('status',__('Sesion agregada exitosamente.'));
    }

    public function updatesesionderecha(TerapiaSesionDerechaFormRequest $request, $id)
    {
        $sesion = TerapiaSesionDerecha::find($id);
        $sesion->antes1 = $request->input('antes1');
        $sesion->antes2 = $request->input('antes2');
        $sesion->antes3 = $request->input('antes3');
        $sesion->antes4 = $request->input('antes4');
        $sesion->despues1 = $request->input('despues1');
        $sesion->despues2 = $request->input('despues2');
        $sesion->despues3 = $request->input('despues3');
        $sesion->despues4 = $request->input('despues4');
        $sesion->update();

        $terapia = Terapia::find($sesion->terapia_id);
        $terapia->update();

        return redirect('show-terapia/'.$sesion->terapia_id)->with('status',__('Sesion actualizada exitosamente.'));
    }

    public function destroysesionderecha($id)
    {
        $sesion = TerapiaSesionDerecha::find($id);
        $sesion->delete();
        return redirect('show-terapia/'.$sesion->terapia_id)->with('status',__('Sesion eliminada exitosamente.'));
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
        // dd($request);
        if ($request)
        {
            $config = Config::first();
            $terapia = Terapia::find($request->input('terapia_id'));
            $miembroIzquierdo = TerapiaSesionIzquierda::where('terapia_id', $terapia->id)->get();
            $miembroDerecha = TerapiaSesionDerecha::where('terapia_id', $terapia->id)->get();

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

            // dd($historia);

            if ( $pdfarchivo == "download" )
            {
                $pdf = PDF::loadView('admin.paciente.terapia.pdfterapia', compact('imagen','terapia','miembroIzquierdo','miembroDerecha','config'));
                $pdf->getDomPDF()->set_option("enable_html5_parser", true);
                $pdf->setPaper($pdftamaño, $pdfhorientacion);
                return $pdf->download ('Terapia: '.$terapia->id.' Paciente: '.$terapia->paciente->nombre.'-'.$nompdf.'.pdf');
            }

            if ( $pdfarchivo == "stream" )
            {
                $pdf = PDF::loadView('admin.paciente.terapia.pdfterapia', compact('imagen','terapia','miembroIzquierdo','miembroDerecha','config'));
                $pdf->getDomPDF()->set_option("enable_html5_parser", true);
                $pdf->setPaper($pdftamaño, $pdfhorientacion);
                return $pdf->stream ('Terapia: '.$terapia->id.' Paciente: '.$terapia->paciente->nombre.'-'.$nompdf.'.pdf');
            }
        }
    }

    private function parseHtml($html)
    {
        $parser = new \Masterminds\HTML5();
        $dom = $parser->parse($html);
        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->query('//p | //h1 | //h2 | //h3 | //h4 | //h5 | //h6 | //img | //ul | //ol | //li');
        $parsedHtml = '';
        foreach ($nodes as $node) {
            $parsedHtml .= $dom->saveHTML($node);
        }
        return $parsedHtml;
    }
}
