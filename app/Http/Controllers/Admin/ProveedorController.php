<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Http\Requests\ProveedorFormRequest;
use DB;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $queryProveedor=$request->input('fproveedor');
            $proveedores = DB::table('proveedors')
            ->where('estado', '=', 1)
            ->where(function ($query) use ($queryProveedor) {
                $query->where('nombre', 'LIKE', '%' . $queryProveedor . '%')
                    ->orWhere('nit', 'LIKE', '%' . $queryProveedor . '%')
                    ->orWhere('contacto', 'LIKE', '%' . $queryProveedor . '%')
                    ->orWhere('email', 'LIKE', '%' . $queryProveedor . '%')
                    ->orWhere('telefono', 'LIKE', '%' . $queryProveedor . '%')
                    ->orWhere('celular', 'LIKE', '%' . $queryProveedor . '%')
                    ->orWhere('numero_cuenta', 'LIKE', '%' . $queryProveedor . '%')
                    ->orWhere('nombre_cuenta', 'LIKE', '%' . $queryProveedor . '%');
                })
            ->orderBy('nombre' , 'asc')
            ->paginate(20);
            return view('admin.proveedor.index', compact('proveedores','queryProveedor'));
        }
    }

    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        return view('admin.proveedor.show', compact('proveedor'));
    }

    public function add()
    {
        return view('admin.proveedor.add');
    }

    public function insert(ProveedorFormRequest $request)
    {
        $proveedor = new Proveedor();
        $proveedor->nombre = $request->input('nombre');
        $proveedor->nit = $request->input('nit');
        $proveedor->contacto = $request->input('contacto');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->celular = $request->input('celular');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->email = $request->input('email');
        $proveedor->banco = $request->input('banco');
        $proveedor->nombre_cuenta = $request->input('nombre_cuenta');
        $proveedor->tipo_cuenta = $request->input('tipo_cuenta');
        $proveedor->numero_cuenta = $request->input('numero_cuenta');
        $proveedor->save();

        // return redirect('proveedores')->with('status', __('Proveedor agregada exitosamente.'));
        return redirect('show-proveedor/'.$proveedor->id)->with('status',__('Proveedor agregada exitosamente.'));
    }

    public function edit($id)
    {
        $proveedor = Proveedor::find($id);
        return view('admin.proveedor.edit', \compact('proveedor'));
    }

    public function update(ProveedorFormRequest $request, $id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->nombre = $request->input('nombre');
        $proveedor->nit = $request->input('nit');
        $proveedor->contacto = $request->input('contacto');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->celular = $request->input('celular');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->email = $request->input('email');
        $proveedor->banco = $request->input('banco');
        $proveedor->nombre_cuenta = $request->input('nombre_cuenta');
        $proveedor->tipo_cuenta = $request->input('tipo_cuenta');
        $proveedor->numero_cuenta = $request->input('numero_cuenta');
        $proveedor->update();
        return redirect('show-proveedor/'.$id)->with('status',__('Proveedor actualizada correctamente.'));

    }

    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->estado = 0;
        $proveedor->update();
        return redirect('proveedores')->with('status',__('Proveedor eliminada correctamente.'));
    }
}
