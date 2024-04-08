<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Cita;
use App\Models\Receta;
use App\Http\Requests\PacienteFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Config;
use PDF;
use DB;

class PacienteController extends Controller
{
    public function pacientes(Request $request)
    {
        if ($request)
        {
            $queryPaciente=$request->input('fpaciente');
            $pacientes = DB::table('pacientes')
            ->where('estado', '=', 1)
            ->where(function ($query) use ($queryPaciente) {
            $query->where('nombre', 'LIKE', '%' . $queryPaciente . '%')
                ->orWhere('email', 'LIKE', '%' . $queryPaciente . '%')
                ->orWhere('telefono', 'LIKE', '%' . $queryPaciente . '%')
                ->orWhere('celular', 'LIKE', '%' . $queryPaciente . '%')
                ->orWhere('dpi', 'LIKE', '%' . $queryPaciente . '%')
                ->orWhere('nit', 'LIKE', '%' . $queryPaciente . '%');
            })
            ->orderBy('nombre','asc')
            ->paginate(20);
            $filterPacientes = Paciente::all();

            return view('admin.paciente.index', compact('pacientes','queryPaciente','filterPacientes'));
        }
    }

    public function show($id)
    {
        $paciente = Paciente::find($id);
        $recetas = Receta::where('paciente_id',$id)->orderBy('fecha', 'desc')->get();
        $citas = Cita::Where('paciente_id',$paciente->id)->orderBy('fecha_cita','desc')->get();
        return view('admin.paciente.show', compact('paciente','citas','recetas'));
    }

    public function add()
    {
        return view('admin.paciente.add');
    }

    public function insert(PacienteFormRequest $request)
    {
        $paciente = new Paciente();
        $fecha_nacimiento = $request->get('fecha_nacimiento');
        $fecha_nacimiento = date("Y-m-d", strtotime($fecha_nacimiento));
        if($request->hasFile('fotografia'))
        {
            $file = $request->file('fotografia');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/imgs/pacientes',$filename);
            $paciente->fotografia = $filename;
        }
        $paciente->estado = 1;
        $paciente->nombre = $request->input('nombre');
        $paciente->ocupacion = $request->input('ocupacion');
        $paciente->fecha_nacimiento = $fecha_nacimiento;
        $paciente->sexo = $request->input('sexo');
        $paciente->telefono = $request->input('telefono');
        $paciente->celular = $request->input('celular');
        $paciente->direccion = $request->input('direccion');
        $paciente->email = $request->input('email');
        $paciente->dpi = $request->input('dpi');
        $paciente->nit = $request->input('nit');
        $paciente->save();

        return redirect('show-paciente/'.$paciente->id)->with('status', __('Paciente agregado  correctamente!'));
    }

    public function edit($id)
    {
        $paciente = Paciente::find($id);
        return view('admin.paciente.edit', \compact('paciente'));
    }

    public function update(PacienteFormRequest $request, $id)
    {
        $paciente = Paciente::find($id);
        // $emailrepeat = Paciente::where('id', '<>', $id)->where('email', $request->input('email'))->count();
        $fecha_nacimiento = $request->get('fecha_nacimiento');
        $fecha_nacimiento = date("Y-m-d", strtotime($fecha_nacimiento));
        if($request->hasFile('fotografia'))
        {
            $path = 'assets/imgs/pacientes/'.$paciente->fotografia;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('fotografia');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/imgs/pacientes',$filename);
            $paciente->fotografia = $filename;
        }
        $paciente->nombre = $request->input('nombre');
        // if ($emailrepeat == "0") {
        //     $paciente->email = $request->input('email');
        // }
        $paciente->ocupacion = $request->input('ocupacion');
        $paciente->fecha_nacimiento = $fecha_nacimiento;
        $paciente->sexo = $request->input('sexo');
        $paciente->telefono = $request->input('telefono');
        $paciente->celular = $request->input('celular');
        $paciente->direccion = $request->input('direccion');
        $paciente->email = $request->input('email');
        $paciente->dpi = $request->input('dpi');
        $paciente->nit = $request->input('nit');
        $paciente->update();

        // if ($emailrepeat >= "1") {
        //     return redirect('show-paciente/'.$id)->with('status',__('Usuario actualizado, email no se pudo editar ya que otro usuario ya lo esta usando.'));
        // }
        return redirect('show-paciente/'.$id)->with('status',__('Paciente actualizado correctamente!'));

    }

    public function destroy($id)
    {
        $paciente = Paciente::find($id);
        if ($paciente->fotografia)
        {
            $path = 'assets/img/pacientes/'.$paciente->fotografia;
            if (File::exists($path))
            {
                File::delete($path);

            }
        }
        $paciente->estado = 0;
        $paciente->email = $paciente->email.'-Deleted'.$paciente->id;
        $paciente->update();
        return redirect('users')->with('status',__('Paciente eliminado correctamente!'));
    }
}
