<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clinica;
use App\Http\Requests\ClinicaFormRequest;
use DB;

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
}
