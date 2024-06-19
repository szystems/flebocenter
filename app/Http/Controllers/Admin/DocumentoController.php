<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Documento;
use App\Http\Requests\DocumentoFormRequest;
use App\Models\Paciente;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use DB;

class DocumentoController extends Controller
{
    public function insert(DocumentoFormRequest $request)
    {
        $documento = new Documento();
        if($request->hasFile('archivo'))
        {
            $file = $request->file('archivo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/imgs/documentos',$filename);
            $documento->archivo = $filename;
        }
        // dd($ext);
        $documento->paciente_id = $request->input('paciente_id');
        $documento->nombre = $request->input('nombre');
        $documento->tipo = $ext;
        $documento->descripcion = $request->input('descripcion');
        $documento->save();

        return redirect('show-paciente/'.$documento->paciente_id)->with('status',__('Documento agregado exitosamente.'));
    }

    public function update(DocumentoFormRequest $request, $id)
    {
        $documento = Documento::find($id);
        if($request->hasFile('archivo'))
        {
            $path = 'assets/imgs/documentos/'.$documento->archivo;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('archivo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/imgs/documentos',$filename);
            $documento->archivo = $filename;
            $documento->tipo = $ext;
        }
        $documento->nombre = $request->input('nombre');
        $documento->descripcion = $request->input('descripcion');
        $documento->update();


        return redirect('show-paciente/'.$documento->paciente_id)->with('status',__('Documento actualizado exitosamente.'));

    }

    public function destroy($id)
    {
        $documento = Documento::find($id);
        $path = 'assets/imgs/documentos/'.$documento->archivo;
            if(File::exists($path))
            {
                File::delete($path);
            }
        $paciente_id = $documento->paciente_id;
        $documento->delete();
        return redirect('show-paciente/'.$paciente_id)->with('status',__('Documento eliminado exitosamente.'));
    }
}
