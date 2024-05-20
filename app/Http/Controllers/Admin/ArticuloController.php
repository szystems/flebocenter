<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Config;
use App\Http\Requests\ArticuloFormRequest;
use Illuminate\Support\Facades\File;
use PDF;
use DB;

class ArticuloController extends Controller
{

    public function index(Request $request)
	{
        if ($request) {
            $articulos = Articulo::query();
            if ($request->has('nombre')) {
                $articulos->where('nombre', 'like', "%{$request->input('nombre')}%");
            }
            if ($request->has('categoria_id')) {
                $articulos->where('categoria_id', 'like', "%{$request->input('categoria_id')}%");
            }
            if ($request->has('proveedor_id')) {
                $articulos->where('proveedor_id', 'like', "%{$request->input('proveedor_id')}%");
            }
            $articulos->where('estado', 1);
            $articulos->orderBy('nombre','asc');
            $articulos = $articulos->paginate(20);

            $categorias = Categoria::where('estado', 1)->get();
            $proveedores = Proveedor::where('estado', 1)->get();
            $config = Config::first();

            return view('admin.articulo.index',compact("request", "articulos", "config","categorias", "proveedores"));
        }
    }

    public function show($id)
    {
        $categorias = Categoria::where('estado', 1)->get();
        $proveedores = Proveedor::where('estado', 1)->get();
        $config = Config::first();
        $articulo = Articulo::find($id);
        return view('admin.articulo.show',compact("articulo","config","categorias", "proveedores"));
    }

    public function add()
    {
        $categorias = Categoria::where('estado', 1)->get();
        $proveedores = Proveedor::where('estado', 1)->get();
        $config = Config::first();
        return view('admin.articulo.add',compact("config","categorias", "proveedores"));
    }

    public function insert(ArticuloFormRequest $request)
    {
        $articulo = new Articulo();
        if($request->hasFile('imagen'))
        {
            $file = $request->file('imagen');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/imgs/articulos',$filename);
            $articulo->imagen = $filename;
        }
        $articulo->nombre = $request->input('nombre');
        $articulo->codigo = $request->input('codigo');
        $articulo->descripcion = $request->input('descripcion');
        $articulo->precio_compra = $request->input('precio_compra');
        $articulo->precio_venta = $request->input('precio_venta');
        $articulo->stock = $request->input('stock');
        $articulo->categoria_id= $request->input('categoria_id');
        $articulo->proveedor_id = $request->input('proveedor_id');
        $articulo->save();

        return redirect('articulos')->with('status', __('Articulo agregado exitosamente.'));
    }

    public function edit($id)
    {
        $categorias = Categoria::where('estado', 1)->get();
        $proveedores = Proveedor::where('estado', 1)->get();
        $config = Config::first();
        $articulo = Articulo::find($id);
        return view('admin.articulo.edit', \compact("articulo","config","categorias", "proveedores"));
    }

    public function update(ArticuloFormRequest $request, $id)
    {
        $articulo = Articulo::find($id);
        if($request->hasFile('imagen'))
        {
            $path = 'assets/imgs/articulos/'.$articulo->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('imagen');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/imgs/articulos',$filename);
            $articulo->imagen = $filename;
        }
        $articulo->nombre = $request->input('nombre');
        $articulo->codigo = $request->input('codigo');
        $articulo->descripcion = $request->input('descripcion');
        $articulo->precio_compra = $request->input('precio_compra');
        $articulo->precio_venta = $request->input('precio_venta');
        $articulo->categoria_id= $request->input('categoria_id');
        $articulo->proveedor_id = $request->input('proveedor_id');
        $articulo->update();

        return redirect('show-articulo/'.$id)->with('status',__('Articulo  actualizado correctamente!'));
    }

    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        $articulo->delete();
        return redirect('articulos')->with('status',__('Articulo eliminado correctamente.'));
    }
}
