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
        // dd($request->all());
        if ($request) {
            $articulos = Articulo::query();
            if ($request->has('nombre') && $request->input('nombre') !== null) {
                $articulos->where(function ($query) use ($request) {
                    $query->where('nombre', 'like', "%{$request->input('nombre')}%")
                        ->orWhere('codigo', 'like', "%{$request->input('nombre')}%");
                });
            }
            if ($request->has('categoria_id') && $request->input('categoria_id') !== null) {
                $articulos->where('categoria_id', '=', $request->input('categoria_id'));
            }
            if ($request->has('proveedor_id') && $request->input('proveedor_id') !== null) {
                $articulos->where('proveedor_id', '=', $request->input('proveedor_id'));
            }
            $articulos->where('estado', 1);
            $articulos->orderBy('nombre','asc');
            $articulos = $articulos->paginate(20);

            $categorias = Categoria::where('estado', 1)->get();
            $proveedores = Proveedor::where('estado', 1)->get();
            $config = Config::first();
            $filtros = $request->all();

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
        $articulo->stock_minimo = $request->input('stock_minimo');
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
        $articulo->stock_minimo = $request->input('stock_minimo');
        $articulo->update();

        return redirect('show-articulo/'.$id)->with('status',__('Articulo  actualizado correctamente!'));
    }

    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        $articulo->delete();
        return redirect('articulos')->with('status',__('Articulo eliminado correctamente.'));
    }

    public function printarticulos(Request $request)
    {
        // dd($request);
        if ($request)
        {
            $farticulo = $request->input('articulo_imprimir');
            $fcategoria = $request->input('categoria_imprimir');
            $fproveedor = $request->input('proveedor_imprimir');

            $articulos = Articulo::query();
            if ($farticulo && $farticulo !== null) {
                $articulos->where(function ($query) use ($farticulo) {
                    $query->where('nombre', 'like', "%{$farticulo}%")
                        ->orWhere('codigo', 'like', "%{$farticulo}%");
                });
            }
            if ($fcategoria && $fcategoria !== null) {
                $articulos->where(function ($query) use ($fcategoria) {
                    $query->where('categoria_id', '=', $fcategoria);
                });
            }
            if ($fproveedor && $fproveedor !== null) {
                $articulos->where(function ($query) use ($fproveedor) {
                    $query->where('proveedor_id', '=', $fproveedor);
                });
            }
            $articulos->where('estado', 1);
            $articulos->orderBy('nombre','asc');
            $articulos = $articulos->get();

            $config = Config::first();
            $nompdf = date('Y-m-d_H-i-s');
            $path = public_path('assets/imgs/');
            $patharticulo = public_path('assets/imgs/articulos/');

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
                $pdf = PDF::loadView('admin.articulo.pdfarticulos', compact('imagen','articulos','request','config','patharticulo'));
                $pdf->getDomPDF()->set_option("enable_html5_parser", true);
                $pdf->setPaper($pdftamaño, $pdfhorientacion);
                return $pdf->download ('Listado de Articulos-'.$nompdf.'.pdf');
            }

            if ( $pdfarchivo == "stream" )
            {
                $pdf = PDF::loadView('admin.articulo.pdfarticulos', compact('imagen','articulos','request','config','patharticulo'));
                $pdf->getDomPDF()->set_option("enable_html5_parser", true);
                $pdf->setPaper($pdftamaño, $pdfhorientacion);
                return $pdf->stream ('Listado de Articulos-'.$nompdf.'.pdf');
            }
        }
    }

    public function printarticulo(Request $request)
    {
        // dd($request);
        if ($request)
        {
            $articulo = Articulo::find($request->input('articulo_id'));

            $config = Config::first();
            $nompdf = date('Y-m-d_H-i-s');
            $path = public_path('assets/imgs/');
            $patharticulo = public_path('assets/imgs/articulos/');

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
                $pdf = PDF::loadView('admin.articulo.pdfarticulo', compact('imagen','articulo','config','patharticulo'));
                $pdf->getDomPDF()->set_option("enable_html5_parser", true);
                $pdf->setPaper($pdftamaño, $pdfhorientacion);
                return $pdf->download ('Articulo: '.$articulo->nombre.'.pdf');
            }

            if ( $pdfarchivo == "stream" )
            {
                $pdf = PDF::loadView('admin.articulo.pdfarticulo', compact('imagen','articulo','config','patharticulo'));
                $pdf->getDomPDF()->set_option("enable_html5_parser", true);
                $pdf->setPaper($pdftamaño, $pdfhorientacion);
                return $pdf->stream ('Articulo paciente: '.$articulo->nombre.'.pdf');
            }
        }
    }
}
