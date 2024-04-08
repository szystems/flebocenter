<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Receta;
use App\Http\Requests\RecetaFormRequest;
use DB;

class RecetaController extends Controller
{

    public function insert(RecetaFormRequest $request)
    {
        $fecha = date("Y-m-d", strtotime($request->fecha));
        $receta = new Receta();
        $receta->paciente_id = $request->input('paciente_id');
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
}
