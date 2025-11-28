<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clinica;
use App\Models\Config;
use App\Http\Requests\ClinicaFormRequest;
use DB;
use PDF;

class ClinicaController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $queryClinica=$request->input('fclinica');
            $clinicas = DB::table('clinicas')
            ->where('estado', '=', 1)
            ->where(function ($query) use ($queryClinica) {
            $query->where('nombre', 'LIKE', '%' . $queryClinica . '%')
                ->orWhere('email', 'LIKE', '%' . $queryClinica . '%')
                ->orWhere('telefono', 'LIKE', '%' . $queryClinica . '%')
                ->orWhere('celular', 'LIKE', '%' . $queryClinica . '%');
            })
            ->paginate(20);
            $filterClinicas = Clinica::all();
            return view('admin.clinica.index', compact('clinicas','queryClinica','filterClinicas'));
        }
    }

    public function show($id)
    {
        $clinica = Clinica::find($id);
        return view('admin.clinica.show', compact('clinica'));
    }

    public function add()
    {
        return view('admin.clinica.add');
    }

    public function insert(ClinicaFormRequest $request)
    {
        $clinica = new Clinica();
        $clinica->nombre = $request->input('nombre');
        $clinica->direccion = $request->input('direccion');
        $clinica->telefono = $request->input('telefono');
        $clinica->celular = $request->input('celular');
        $clinica->email = $request->input('email');
        $clinica->descripcion = $request->input('descripcion');
        $clinica->estado = 1;
        $clinica->save();

        // return redirect('clinicas')->with('status', __('Clínica agregada exitosamente.'));
        return redirect('show-clinica/'.$clinica->id)->with('status',__('Clínica agregada exitosamente.'));
    }

    public function edit($id)
    {
        $clinica = Clinica::find($id);
        return view('admin.clinica.edit', \compact('clinica'));
    }

    public function update(ClinicaFormRequest $request, $id)
    {
        $clinica = Clinica::find($id);
        $clinica->nombre = $request->input('nombre');
        $clinica->direccion = $request->input('direccion');
        $clinica->telefono = $request->input('telefono');
        $clinica->celular = $request->input('celular');
        $clinica->email = $request->input('email');
        $clinica->descripcion = $request->input('descripcion');
        $clinica->update();
        return redirect('show-clinica/'.$id)->with('status',__('Clínica actualizada correctamente.'));

    }

    public function destroy($id)
    {
        $clinica = Clinica::find($id);
        $clinica->estado = 0;
        $clinica->update();
        return redirect('clinicas')->with('status',__('Clínica eliminada correctamente.'));
    }

    public function pdf(Request $request)
    {
        if ($request)
        {

            $clinicas = Clinica::where('estado',1)->orderBy('nombre','asc')->get();
            $verpdf = "Browser";
            $nompdf = date('Y-m-d_H-i-s');
            $path = public_path('assets/imgs/');

            $config = Config::first();

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


            $config = Config::first();

            if ( $verpdf == "Download" )
            {
                $pdf = PDF::loadView('admin.clinica.pdf',['clinicas'=>$clinicas,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->download ('Listado Clinicas '.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.clinica.pdf',['clinicas'=>$clinicas,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->stream ('Listado Clinicas '.$nompdf.'.pdf');
            }
        }
    }

    public function pdfclinica($id)
    {

        $clinica = Clinica::find($id);
        $verpdf = "Browser";
        $nompdf = date('Y-m-d_H-i-s');
        $path = public_path('assets/imgs/');

        $config = Config::first();

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


        $config = Config::first();

        if ( $verpdf == "Download" )
        {
            $pdf = PDF::loadView('admin.clinica.pdfclinica',['clinica'=>$clinica,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

            return $pdf->download ('Clinica: '.$clinica->nombre.'-'.$nompdf.'.pdf');
        }
        if ( $verpdf == "Browser" )
        {
            $pdf = PDF::loadView('admin.clinica.pdfclinica',['clinica'=>$clinica,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

            return $pdf->stream ('Clinica: '.$clinica->nombre.'-'.$nompdf.'.pdf');
        }
    }
}
